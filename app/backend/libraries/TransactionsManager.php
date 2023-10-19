<?php

namespace backend\libraries;

use Yii;
use yii\db\Command;
use yii\db\Query;
use yii\web\Controller;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
use backend\models\Loans;
use backend\models\Accounts;
use backend\models\Members;
use backend\models\Transactions;
use backend\libraries\TransactionsManager;



/**
* Transactions
*/
class TransactionsManager 
{

    // Transaction Name/Type
	const DEPOSIT="DEPOSIT";
	const WITHDRAWAL="WITHDRAWAL";
	const PROFILE="PROFILE";
	const SALES="SALES";

	const TAXES="TAXES";
	const FEES="FEES";

    const OWNER="SYSTEM";
    const WINNINGS="WINNINGS";


	/**
     * Generate unique and random code to id a transaction, 
     * @param $strength (number of characters)
     * @return array
     */
    public static function generateTransactionCode($strength) {
        $character_pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($character_pool);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $character_pool[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }


    /**
     * Generate unique and random code to id an order_claim, 
     * @param $strength (number of characters)
     * @return array
     */
    public static function generateOrderCode() {
        $strength = 2;
        $character_pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $number_pool = '0123456789';
        $input_length = strlen($character_pool);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $character_pool[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        for ($i = 0; $i < 4; $i++) {
            $random_character = $number_pool[mt_rand(0, strlen($number_pool) - 1)];
            $random_string .= $random_character;
        }


        return $random_string;
    }

    
    
    /**
     * pay for an order that has been placed, 
     * @param $user_id
     * , $amount
     * @return array
     */
    public function payForOrder($client_id, $amount, $msisdn) {
        $gateway = "MPESA";
        $member = Members::find()->where(['client_id' => $client_id])->andWhere(['phone' =>$msisdn])->one();
        $member_id = $member->id;
        
        $connection = \Yii::$app->db;
        $isolationLevel = \yii\db\Transaction::SERIALIZABLE;
        $transaction = Yii::$app->db->beginTransaction($isolationLevel);
        try {

            # check loan eligibility
            $transactionsTable = Transactions::tableName();

            $profileLoanAccount = Accounts::find()->where(['type' => 'MEMBER LOAN'])->andWhere(['member_id' => $member_id])->andWhere(['client_id' => $client_id])->one();
            $mobileLoansAccount = Accounts::find()->where(['type' => 'MOBILE LOANS'])->andWhere(['client_id' => $client_id])->one();

            $transactionCode = TransactionsManager::generateTransactionCode(9);
            $transaction_record = $connection->createCommand()
                ->insert($transactionsTable, [
                    'reference_code' => $transactionCode,
                    'transaction_type' => 'LOAN PAYMENT',
                    'description' => 'The funds to service an active loan',
                    'status' => 'successful',
                    'amount' => $amount,
                    'payment_gateway' => $gateway,
                    'member_id' => $member_id
                ])->execute();
      
            /** debit profileLoanAccount to reduce loan balance */   
            $profileLoanBalance = $profileLoanAccount->credit - ($profileLoanAccount->debit + $amount);
            $debit = $profileLoanAccount->debit + $amount;
            $debitProfileLoanAccount = $connection->createCommand()
                ->update('accounts', [
                    'balance' => $profileLoanBalance, 
                    'debit' => $debit
                ], 
                [
                  'id' => $profileLoanAccount->id,
                  'member_id' => $member_id,
                  'client_id' => $client_id
                ])->execute();
          

            $profileLedger = $connection->createCommand()
              ->insert('ledgers', [
                  'transaction_id' => $transactionCode,
                  'amount' => $amount,
                  'credit' => 0,
                  'debit' => $debit,
                  'balance' => $profileLoanBalance,
                  'member_id' => $member_id,
                  'account_id' => $profileLoanAccount->id
              ])->execute();

                            
            /** debit mobileLoansAccount to reduce claimed by sacco */   
            $mobileLoansBalance = ($mobileLoansAccount->credit + $amount) - $mobileLoansAccount->debit;           
            $credit = $mobileLoansAccount->credit + $amount;
            $creditMobileLoansAccount = $connection->createCommand()
                ->update('accounts', [
                    'balance' => $mobileLoansBalance,
                    'credit' => $credit
                ], 
                [
                    'type' => 'MOBILE LOANS',
                    'id' => $mobileLoansAccount->id
                ])->execute();


            /** insert mobileLoansAccount debit ledger */                
            $creditLedger = $connection->createCommand()
                ->insert('ledgers', [
                    'transaction_id' => $transactionCode,
                    'amount' => $amount,
                    'credit' => $credit,
                    'debit' => 0,
                    'balance' => $mobileLoansBalance,
                    'member_id' => $member_id,
                    'account_id' => $mobileLoansAccount->id
                ])->execute();


            # Update the loans record
            $loan = Loans::find()->where(['client_id' => $client_id])->andWhere(['member_id' => $member_id ])->andWhere(['status' => 'PERFORMING'])->one();
            if(!empty($loan)){

                # handle loan overpayment scenario
                if($amount > $loan->balance){
                    $overpayment = $amount - $loan->balance;
                    self::depositFunds($member_id, $client_id, $overpayment);
                    $amount -= $overpayment; #adjust the amount to pay as loan
                    $settlement_status = self::canSettleLoan($loan->amount, $loan->balance, $amount); 

                   $connection->createCommand()
                   ->update('loans', [
                       'balance' => ($loan->balance - $amount),
                       'status' => 'SETTLED'
                   ], 
                   [
                       'id' => $loan->id
                   ])->execute();

                } else {

                    $connection->createCommand()
                    ->update('loans', [
                        'balance' => ($loan->balance - $amount),
                        'status' => 'PERFORMING'
                    ], 
                    [
                        'id' => $loan->id
                    ])->execute();
                }

            }

            $transaction->commit();
            return ['message' => 'Loan payment was successful'];

        } catch(Exception $e) {
            $transaction->rollback();
        }
    }

    
    /**
     * service an active loan, 
     * debits deposit account & credits profile account
     * @param $member_id, $amount
     * @return array
     */
    public function payLoan($client_id, $amount, $msisdn) {
        $gateway = "MPESA";
        $member = Members::find()->where(['client_id' => $client_id])->andWhere(['phone' =>$msisdn])->one();
        $member_id = $member->id;
        
        $connection = \Yii::$app->db;
        $isolationLevel = \yii\db\Transaction::SERIALIZABLE;
        $transaction = Yii::$app->db->beginTransaction($isolationLevel);
        try {

            # check loan eligibility
            $transactionsTable = Transactions::tableName();
            $profileLoanAccount = Accounts::find()->where(['type' => 'MEMBER LOAN'])->andWhere(['member_id' => $member_id])->andWhere(['client_id' => $client_id])->one();
            $mobileLoansAccount = Accounts::find()->where(['type' => 'MOBILE LOANS'])->andWhere(['client_id' => $client_id])->one();
            $transactionCode = TransactionsManager::generateTransactionCode(9);

            $transaction_record = $connection->createCommand()
                ->insert($transactionsTable, [
                    'reference_code' => $transactionCode,
                    'transaction_type' => 'LOAN PAYMENT',
                    'description' => 'The funds to service an active loan',
                    'status' => 'successful',
                    'amount' => $amount,
                    'payment_gateway' => $gateway,
                    'member_id' => $member_id
                ])->execute();
      
            /** debit profileLoanAccount to reduce loan balance */   
            $profileLoanBalance = $profileLoanAccount->credit - ($profileLoanAccount->debit + $amount);
            $debit = $profileLoanAccount->debit + $amount;
            $debitProfileLoanAccount = $connection->createCommand()
                ->update('accounts', [
                    'balance' => $profileLoanBalance, 
                    'debit' => $debit
                ], 
                [
                  'id' => $profileLoanAccount->id,
                  'member_id' => $member_id,
                  'client_id' => $client_id
                ])->execute();
          

            $profileLedger = $connection->createCommand()
              ->insert('ledgers', [
                  'transaction_id' => $transactionCode,
                  'amount' => $amount,
                  'credit' => 0,
                  'debit' => $debit,
                  'balance' => $profileLoanBalance,
                  'member_id' => $member_id,
                  'account_id' => $profileLoanAccount->id
              ])->execute();

                            
            /** debit mobileLoansAccount to reduce claimed by sacco */   
            $mobileLoansBalance = ($mobileLoansAccount->credit + $amount) - $mobileLoansAccount->debit;           
            $credit = $mobileLoansAccount->credit + $amount;
            $creditMobileLoansAccount = $connection->createCommand()
                ->update('accounts', [
                    'balance' => $mobileLoansBalance,
                    'credit' => $credit
                ], 
                [
                    'type' => 'MOBILE LOANS',
                    'id' => $mobileLoansAccount->id
                ])->execute();


            /** insert mobileLoansAccount debit ledger */                
            $creditLedger = $connection->createCommand()
                ->insert('ledgers', [
                    'transaction_id' => $transactionCode,
                    'amount' => $amount,
                    'credit' => $credit,
                    'debit' => 0,
                    'balance' => $mobileLoansBalance,
                    'member_id' => $member_id,
                    'account_id' => $mobileLoansAccount->id
                ])->execute();


            # Update the loans record
            $loan = Loans::find()->where(['client_id' => $client_id])->andWhere(['member_id' => $member_id ])->andWhere(['status' => 'PERFORMING'])->one();
            if(!empty($loan)){

                # handle loan overpayment scenario
                if($amount > $loan->balance){
                    $overpayment = $amount - $loan->balance;
                    self::depositFunds($member_id, $client_id, $overpayment);
                    $amount -= $overpayment; #adjust the amount to pay as loan
                    $settlement_status = self::canSettleLoan($loan->amount, $loan->balance, $amount); 

                   $connection->createCommand()
                   ->update('loans', [
                       'balance' => ($loan->balance - $amount),
                       'status' => 'SETTLED'
                   ], 
                   [
                       'id' => $loan->id
                   ])->execute();

                } else {

                    $connection->createCommand()
                    ->update('loans', [
                        'balance' => ($loan->balance - $amount),
                        'status' => 'PERFORMING'
                    ], 
                    [
                        'id' => $loan->id
                    ])->execute();
                }

            }

            $transaction->commit();
            return ['message' => 'Loan payment was successful'];

        } catch(Exception $e) {
            $transaction->rollback();
        }
    }

    
    /**
     * DEPOSIT money to instaloans wallet, 
     * debits deposit account & credits profile account
     * @param $client_id, $member_id, $amount
     * @return array
     */
    public function depositFunds($member_id, $client_id, $amount) {
        $gateway = "INTERNAL";


        
        $connection = \Yii::$app->db;
        $isolationLevel = \yii\db\Transaction::SERIALIZABLE;
        $transaction = Yii::$app->db->beginTransaction($isolationLevel);
        try {

            $transactionsTable = Transactions::tableName();
            $profileAccount = Accounts::find()->where(['type' => 'MEMBER'])->andWhere(['member_id' => $member_id])->andWhere(['client_id' => $client_id])->one();
            $depositAccount = Accounts::find()->where(['type' => 'DEPOSITS'])->andWhere(['client_id' => $client_id])->one();;
            $transactionCode = TransactionsManager::generateTransactionCode(9);


            $transaction_record = $connection->createCommand()
                ->insert($transactionsTable, [
                    'reference_code' => 'RF'.$transactionCode,
                    'transaction_type' => 'LOAN OVERPAYMENT',
                    'description' => 'Refund due to overpayment of loan',
                    'status' => 'successful',
                    'amount' => $amount,
                    'payment_gateway' => $gateway,
                    'member_id' => $member_id
                ])->execute();
      
            /** update profile account */   
            $profileBalance = ($profileAccount->credit + $amount) - ($profileAccount->debit);
            $credit = $profileAccount->credit + $amount;
            $creditProfileAccount = $connection->createCommand()
                ->update('accounts', [
                    'balance' => $profileBalance, 
                    'credit' => $credit
                ], 
                [
                    'member_id' => $member_id
                ])->execute();


          
            /** insert profile ledgers */
            $sql = "INSERT INTO ledgers (transaction_id, amount, credit, debit, balance, account_id )
                    VALUES ('$transactionCode', '$amount', '$credit', 0, '$profileBalance', '$profileAccount->id')";
            $profileLedger = \Yii::$app->db->createCommand($sql)->execute();
            
            /** update deposit account */   
            $depositBalance = ($depositAccount->credit) - ($depositAccount->debit + $amount);           
            $debit = $depositAccount->debit + $amount;
            $debitDepositAccount = $connection->createCommand()
                ->update('accounts', [
                    'balance' => $depositBalance,
                    'debit' => $debit
                ], 
                [
                    'type' => 'DEPOSITS'
                ])->execute();

            /** insert deposit ledger */                
            $creditLedger = $connection->createCommand()
                ->insert('ledgers', [
                    'transaction_id' => $transactionCode,
                    'amount' => $amount,
                    'credit' => 0,
                    'debit' => $debit,
                    'balance' => $depositBalance,
                    'member_id' => $member_id,
                    'account_id' => $depositAccount->id
                ])->execute();

            $transaction->commit();
            return array( 'status' => 'payment received' ); # send overpayment message

        } catch(Exception $e) {
            $transaction->rollback();
        }

    }


    /**
     * trigger an stk push for Lipa Na mpesa online
     * @param $msisdn and $amount
     * @return array 
     */
    public function payForFriend($amount,$order_id, $msisdn, $client_id){
  
        $initiate_url = Configs::INITIATE_URL;
        $BusinessShortCode = Configs::BUSINESS_SHORTCODE;
        $PartyA = $msisdn; 
        $AccountReference = $PartyA;
        $TransactionDesc  = self::SALES;
        $Amount = $amount;
        $Passkey = Configs::PASS_KEY;  
        $Timestamp = date('YmdHis');
        // $Timestamp = "20160216165627";
        $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
        // $Password = "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTYwMjE2MTY1NjI3";
        $CallBackURL = Configs::CALLBACK_URL;
        $stkheader = [
            'Content-Type:application/json',
            'Authorization:Bearer '.Configs::generateAccessToken()
        ];

        # initiating the transaction
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $initiate_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

        $curl_post_data = array(
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $BusinessShortCode,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $CallBackURL,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);

        $stk_result =  json_decode($curl_response);
        
        # log the payment request for reconciliation
        $connection = \Yii::$app->db;
        $transaction_record = $connection->createCommand()
          ->insert('incoming_payment_logs', [
            'msisdn' => $msisdn,
            'order_id' => $order_id,
            'merchant_request_id' => $stk_result->MerchantRequestID,
              'checkout_request_id' => $stk_result->CheckoutRequestID,
              'response_code' => $stk_result->ResponseCode,
              'response_desc' => $stk_result->ResponseDescription,
              'customer_message' => $stk_result->CustomerMessage,
              'client_id' => $client_id
          ])->execute();

        return $stk_result;
      
    }
    

    /**
     * calculate number of items in basket
     * @param $client_id and $order_id
     * @return array 
     */
    public function countOrderItems($client_id, $order_id){

        $query = "SELECT  COUNT(oi.product_id) AS items FROM orders o 
                  LEFT JOIN order_items oi ON oi.order_id=o.id 
                  WHERE  o.client_id='$client_id' AND o.id='$order_id' 
                  GROUP BY oi.order_id;";

        $order =\Yii::$app->db->createCommand($query)->queryOne() ; 
        return $order['items'];

    }

//    /**
//      * calculate number of items in basket
//      * @param $client_id and $order_id
//      * @return array 
//      */
//     public function count$client_id, $order_id){

//         $query = "SELECT  COUNT(oi.product_id) AS items FROM orders o 
//                   LEFT JOIN order_items oi ON oi.order_id=o.id 
//                   WHERE  o.client_id='$client_id' AND o.id='$order_id' 
//                   GROUP BY oi.order_id;";

//         $order =\Yii::$app->db->createCommand($query)->queryOne() ; 
//         return $order['items'];

    // }

    
}

?>