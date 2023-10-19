<?php

namespace backend\controllers;
date_default_timezone_set('Africa/Nairobi');

use DateTime;
use DateInterval;
use Yii;
use yii\base\ErrorException;
use yii\web\UploadedFile;
use yii\web\BadRequestHttpException;
use yii\web\Response;

use yii\db\Command;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\models\Loans;
use backend\models\User;
use backend\models\ClientAdmins;
use backend\models\Clients;
use backend\models\Categories;
use backend\models\Members;
use backend\models\Accounts;
use backend\models\Transactions;
use backend\models\Authentication;
use backend\libraries\TransactionsManager;
use backend\libraries\Commons;
use backend\libraries\Configs;
use backend\libraries\Statuses;
use backend\libraries\Notify;


use yii\rest\ActiveController;

// \Sentry\init(['dsn' => 'https://2cf39180c9b04a9fba8a2e82fcabf344@o197133.ingest.sentry.io/6363658' ]);

/**
 * ApiController implements the api actions
 */
class ApiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors() {

        return [

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   
                    'initiate-payment' => ['GET'],
                    'deposit' => ['GET', 'POST'],
                    'all-deposits' => ['GET'],
                    'webhook' => ['POST','GET'],
                    'send-bulk-sms' => ['POST','POST'],
                    'send-bulk-email' => ['POST','POST'],
                  ],
            ],

        ];

    }


    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $excludeActions = ['all-deposits', 'webhook', 'send-bulk-sms', 'send-bulk-email', 'initiate-payment'];
        
        if (in_array($action->id, $excludeActions)) {
            $this->enableCsrfValidation = false;
            Yii::$app->response->format = Response::FORMAT_JSON;
        }
        
        return parent::beforeAction($action);
    }
    
    

  
    /**
     * trigger an stk push for Lipa Na mpesa online
     * @param $msisdn and $amount
     * @return array 
     */
    public function actionInitiatePayment(){
    
        if (isset($_GET['amount'])) {
            $amount = $_GET['amount'];
         } else {
              $data =  array(
                'status' => false,
                'status_message' => 'missing amount'
              );
            return $data;
        }

        if(isset($_GET['msisdn'])) {
          $msisdn = $_GET['msisdn'];
  
          }else {
          return [ 'status' => false, 'status_message' => 'missing msisdn' ];
        }

        # log the payment request for reconciliation
        $stk_result = Configs::MpesaSandboxStkPush($amount, $msisdn);
        //  $stk_result = Configs::LipaNaMpesaStkPush($amount, $msisdn);
        //  $stk_result = Configs::TopUpMswaliMpesaStkPush($amount, $msisdn);
        

        $connection = \Yii::$app->db;
        $transaction_record = $connection->createCommand()
          ->insert('incoming_payment_logs', [
              'msisdn' => $msisdn,
              'merchant_request_id' => $stk_result->MerchantRequestID,
              'checkout_request_id' => $stk_result->CheckoutRequestID,
              'response_code' => $stk_result->ResponseCode,
              'response_desc' => $stk_result->ResponseDescription,
              'customer_message' => $stk_result->CustomerMessage,
            //   'amount' => $amount,
              'client_id' => 1
          ])->execute();

        return $stk_result;
      
    }



    /**
     * Listens and receives funds credited on profile wallet from c2b callback
     * and performs the book keeping on deposit & profile accounts
     * @param takes c2b(lnmo) callback response data from daraja API
     * @return array
     */
    public function actionWebhook() {
        
        // Notify::sendSMS('callback invoked','0707630747');
        $data = file_get_contents('php://input');
        // $data = '{"Body":{"stkCallback":{"MerchantRequestID":"43064-128289206-1", "CheckoutRequestID":"ws_CO_310320221134594823", "ResultCode":0,"ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","Value":50.00},{"Name":"MpesaReceiptNumber","Value":"QCU1J35A9P"},{"Name":"TransactionDate","Value":20220330170237},{"Name":"PhoneNumber","Value":254707630747}]}}}}';
        // $data = '{"Body":{"stkCallback":{"MerchantRequestID":"79306-52596481-1", "CheckoutRequestID":"ws_CO_310320221127460729", "ResultCode":0,"ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","Value":1.00},{"Name":"MpesaReceiptNumber","Value":"QCU1J35A9P"},{"Name":"TransactionDate","Value":20220330170237},{"Name":"PhoneNumber","Value":254707630747}]}}}}';

        if(empty($data)){ Notify::sendSMS( 'empty','0707630747'); return ['status' => false, 'message' => 'stk callback is empty']; }
        $posted = json_decode($data);


        $callback = $posted->Body->stkCallback;
        $MerchantRequestID = $callback->MerchantRequestID;
        $CheckoutRequestID = $callback->CheckoutRequestID;
        $ResultCode = $callback->ResultCode;
        $ResultDesc = $callback->ResultDesc;

        if($ResultCode==0) {
            # Get the Metadata from MPESA response
            $metaData=$posted->Body->stkCallback->CallbackMetadata->Item;
            $master = array();
            foreach ($metaData as $item) {
                $item = (array)$item;
                $master[$item["Name"]] = ((isset($item["Value"])) ? $item["Value"] : NULL); # create usable objects off of the mpesa response array objects and append them to a new array (master)
            }
            $master = (object)$master;

            # UPDATE TRANSACTION LOG
            $connection = \Yii::$app->db;
            $transaction_record = $connection->createCommand()
                ->update('incoming_payment_logs', [
                'amount' => $master->Amount,
                'mpesa_receipt' => $master->MpesaReceiptNumber,
                'transaction_date' => $master->TransactionDate,
                'status' => 'CLOSED'
            ], 
            [
              'merchant_request_id' => $MerchantRequestID,
              'checkout_request_id' => $CheckoutRequestID,
            ])->execute();

            # Select incoming client 
            # service the loan

            $row = (new \yii\db\Query())
            ->select(['msisdn', 'client_id'])
            ->from('incoming_payment_logs')
            ->where(['merchant_request_id' => $MerchantRequestID])
            ->andWhere(['checkout_request_id' => $CheckoutRequestID])
            ->one();   

            # settle the order
            Notify::sendSMS( 'You have made a payment of Kshs '.$master->Amount.' via Paysol. Your M-Pesa receipt is '.$master->MpesaReceiptNumber, $master->PhoneNumber);

            return ['status' => true, 'message' => 'transaction has been reconciled'];
            // $data = file_get_contents('php://input')  

        } else {
            return ['status' => false, 'message' => 'withrawal is successful', 'callback' => $callback ];
        }


    }

  
    /**
    * Retrieves all deposits made in the system.
    *
    * @return array An array of all deposits made.
    */
    public function actionAllDeposits() {

        //   $startDate = date('Y-m-d H:i:s', strtotime('-7 days'));
        //   $endDate = date('Y-m-d H:i:s');
        $connection = \Yii::$app->db;
        $query = (new \yii\db\Query())
                ->select('merchant_request_id, amount, msisdn, client_id, status, inserted_at')
                // ->select('status, amount, inserted_at')
                ->from('incoming_payment_logs')
                ->where(['not', ['amount' => null]]); 
                // ->where(['status' => 'CLOSED']);
                // ->where(['status' => 'PENDING']);
                // ->andWhere(['between', 'inserted_at', $startDate, $endDate]);
        $transaction_records = $query->all($connection);

        $total = 0;
        foreach ($transaction_records as $record) {
            if (!is_null($record['amount'])) {
                $total += (float) $record['amount'];
            }
        }

        $settled = 0;
        $pending = 0;

        if (empty($transaction_records)) {
            $result = [
                'status' => false,
                'status_message' => 'No records found',
                'total' => $total,
                'settled' => $settled,
                'pending' => $pending
            ];
        } else {
            $result = [
                'status' => true,
                'status_message' => 'Found '.count($transaction_records). ' records',
                'total' => $total,
                'settled' => $settled,
                'pending' => $pending,
                'data' => $transaction_records,
                'sub_totals' => Commons::aggregateTotalsByDay($transaction_records)
            ];
        }
        
        return $result;
      
    }



    /**
     * Receives the payload for sending bulk SMS.
     *
     * @return array The response indicating the success or failure of the SMS sending process.
     * @throws BadRequestHttpException if the payload is invalid or missing required data.
     */
    public function actionSendBulkSms()
    {
        $params = Yii::$app->request->post();
        $requiredParams = [ 'api_key', 'secret_key', 'sender_id', 'phone_numbers', 'message' ];
        
        foreach ($requiredParams as $param) {
            if (empty($params[$param])) {
                Yii::$app->response->statusCode = 400;
                return [
                    'status' => Yii::$app->response->statusCode,
                    'status_message' => 'Missing ' . $param,
                    'data' => null,
                ];
            }
            // statically create variables from keys ie $api_key, $secret_key, $sender ...
            ${$param} = $params[$param];           
        }


        # STEP 1 authenticate keys

        # STEP 2 log request to log table  and return batch id

        return [
            'status' => Yii::$app->response->statusCode,
            'status_message' => 'request received susscessfully',
            'batchID' => 123,
        ];
    
        
    }

    /** 
    * Receives the payload for sending bulk email.
    *
    * @return array The response indicating the success or failure of the email sending process.
    * @throws BadRequestHttpException if the payload is invalid or missing required data.
    */
    public function actionSendBulkEmail()
    {
            $params = Yii::$app->request->post();
            $requiredParams = [ 'api_key', 'secret_key', 'sender', 'recipients', 'subject', 'message' ];

            foreach ($requiredParams as $param) {
                if (empty($params[$param])) {
                    return [
                        'status' => Yii::$app->response->statusCode = 400,
                        'status_message' => 'Missing ' . $param,
                        'data' => null,
                    ];
                }
                // statically create variables from keys ie $api_key, $secret_key, $sender ...
                ${$param} = $params[$param];           
            }


        # STEP 1 authenticate keys

        # STEP 2 log email request to batch email table and return batch id

        return [
            'status' => Yii::$app->response->statusCode,
            'status_message' => 'request received susscessfully',
            'batchID' => 123, // get sample batch id after inseting into the  batch table
        ];
    }




}
