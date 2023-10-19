<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Payment {

    private $consumerKey;
    private $consumerSecret;
    private $env;
    private $accessUrl;
    private $initiateUrl;
    private $callbackUrl;
    private $businessShortcode;


    public function __construct() {
        $this->consumerKey = $_ENV['MPESA_CONSUMER_KEY'];
        $this->consumerSecret = $_ENV['MPESA_CONSUMER_SECRET'];
        $this->env = $_ENV['MPESA_ENV'];
        $this->initiateUrl = $_ENV['INITIATE_URL'];
        $this->accessUrl = $_ENV['ACCESS_URL'];
        $this->callbackUrl = $_ENV['CALLBACK_URL'];
        $this->businessShortcode = $_ENV['BUSINESS_SHORTCODE'];
        $this->businessShortcode = $_ENV['PASSKEY'];
    }


    /**
     * Generates token for for Lipa Na mpesa online
     * @param none
     * @return (token)
     */
    public function generateAccessToken() {

        $headers = ['Content-Type:application/json; charset=utf8'];
        $access_token_url = $this->accessUrl;
    
        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_USERPWD, $this->consumerKey.':'.$this->consumerSecret);

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);

        $access_token = $result->access_token;

        return $access_token;
    }


            /**
     * trigger an stk push for Lipa Na mpesa online
     * @param $msisdn and $amount
     * @return array 
     */
    public function makePayment( $amount, $acount_number){

        // $initiateUrl = $initiateUrl;
        // $businessShortCode = $businessShortcode;
        // $PartyA = $account_number; 
        // $AccountReference = $PartyA;
        // $TransactionDesc  = 'DEPOSIT';
        // $Amount = $amount;
        // $Passkey = $PASS_KEY;  
        // $Timestamp = date('YmdHis');
        // $Password = base64_encode($businessShortCode.$Passkey.$Timestamp);
        // $CallBackURL = $callbackUrl;
        $stkheader = [
            'Content-Type:application/json',
            'Authorization:Bearer '.self::generateAccessToken()
        ];

        # initiating the transaction
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->initiateUrl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

        $curl_post_data = array(

                "BusinessShortCode" => $this->businessShortcode,    
                "Password" => "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTYwMjE2MTY1NjI3",    
                "Timestamp" => "20160216165627",    
                "TransactionType" => "CustomerPayBillOnline",    
                "Amount" => $amount,
                "PartyA" => $acount_number,    
                "PartyB" => "174379",    
                "PhoneNumber" => $acount_number,    
                "CallBackURL" => $this->callbackUrl,    
                "AccountReference" => "Test",    
                "TransactionDesc" => "Test"
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);

        return $stk_result =  json_decode($curl_response);
        

    }

        /**
     * Listens and receives funds credited on profile wallet from c2b callback
     * and performs the book keeping on deposit & profile accounts
     * @param takes c2b(lnmo) callback response data from daraja API
     * @return array
     */
    public function webhook() {
    
        $data = file_get_contents('php://input');
        if(!$data) {
            return "Invalid Request";
        }

        $data = json_decode($data);

        $callback = $data->Body->stkCallback;

        $MerchantRequestID = $callback->MerchantRequestID;
        $CheckoutRequestID = $callback->CheckoutRequestID;
        $ResultCode = $callback->ResultCode;
        $ResultDesc = $callback->ResultDesc;

        if($ResultCode==0)
        {
            //Get the Metadata from MPESA response
            $metaData=$data->Body->stkCallback->CallbackMetadata->Item;

            $master = array();
            foreach ($metaData as $item) {
                $item = (array)$item;
                # create usable objects off of the mpesa response array objects and append them to a new array (master)
                $master[$item["Name"]] = ((isset($item["Value"])) ? $item["Value"] : NULL);
            }
            $master = (object)$master;

            // $User = $this->findUser($master->PhoneNumber);
            // $creditData =  array("user_id" => $User, "amount" => $master->Amount );
            
            // if ($master->Amount >= 20){
            //     $this->postRequest('http://161.35.6.91/mswali/mswali_app/backend/web/index.php?r=api/deposit&'.http_build_query($creditData), false);
            //     $this->queueSMS('You have deposited Ksh '.$master->Amount.' to your mSwali Wallet. Play to WIN CASH in the next Quiz.', $master->PhoneNumber);
                
            // } else {
            //     $thresholdBalanceAlert = "Please ensure you have at least Ksh 20 in your wallet to play.";
            //     $this->postRequest('http://161.35.6.91/mswali/mswali_app/backend/web/index.php?r=api/deposit&'.http_build_query($creditData), false);
            //     $this->queueSMS('You have deposited Ksh '.$master->Amount.' to your mSwali Wallet. Play to WIN CASH in the next Quiz. ' .$thresholdBalanceAlert, $master->PhoneNumber);
            // }
     
        }
    }


}

$payment = new Payment();
echo $payment->makePayment(1,'254707630747');
$resp = $payment->generateAccessToken();
print_r($resp);