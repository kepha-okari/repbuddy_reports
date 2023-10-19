<?php

namespace backend\libraries;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
/**
* Common functions
*/
class Configs 
{

    const ROOT_URL =  'http:/161.35.6.91/qula/backend/web/uploads/';
    
    // #  LNMO access token credentials
    // const LNMO_CONSUMER_KEY="IqkBxE1AHAdy4Z9IvnZaZA3VbI5vGAIj";
    // const LNMO_CONSUMER_SECRET="rLN3i0xBp4t8r2tV";
    // const ACCESS_TOKEN_URL  = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
    // const INITIATE_URL = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    // const CALLBACK_URL =  'http://161.35.6.91/adminhub/app/backend/web/index.php/api/webhook';
    // const BUSINESS_SHORTCODE = "174379";
    // const PASS_KEY = 'MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTYwMjE2MTY1NjI3';  


    // const LNMO_CONSUMER_KEY="Gd5u7leQx76f3AtKr8FCWn5wVSjFPyGY";
    // const LNMO_CONSUMER_SECRET="MqjnyP0yqlpcj6cB";
    // const PROD_ACCESS_TOKEN_URL  = "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

    // // const CALLBACK_URL =  'http://197.248.4.233/mswali/mswali_app/backend/web/index.php?r=api/webhook';
    // const CALLBACK_URL =  'http://161.35.6.91/adminhub/app/backend/web/index.php/api/webhook';




    /**
     * Generates token for for Lipa Na mpesa online
     * @param none
     * @return (token)
     */
    public static function generateSandboxAccessToken() {
        $consumerKey = 'IqkBxE1AHAdy4Z9IvnZaZA3VbI5vGAIj';
        $consumerSecret = 'rLN3i0xBp4t8r2tV'; 
   
        $headers = ['Content-Type:application/json; charset=utf8'];
        $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    
        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);

        $access_token = $result->access_token;

        return $access_token;
    }



    /**
     * Generates token for for Lipa Na mpesa online
     * @param none
     * @return (token)
     */
    public static function generateMswaliAccessToken() {
        $consumerKey ='Gd5u7leQx76f3AtKr8FCWn5wVSjFPyGY';
        $consumerSecret = 'MqjnyP0yqlpcj6cB'; 


        $headers = ['Content-Type:application/json; charset=utf8'];
        $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    
        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);

        $access_token = $result->access_token;

        return $access_token;
    }


    /**
     * Generates token for for Lipa Na mpesa online
     * @param none
     * @return (token)
     */
    private static function generateOliveAccessToken()
    {
        $consumerKey = 'A7Ak2sR8GZFrI4X6Gtx3XzGSjNR1IkW1';
        $consumerSecret = 'DiJxQx4suq4jhOZQ';

        $headers = ['Content-Type:application/json; charset=utf8'];
        $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);

        $access_token = $result->access_token;

        return $access_token;
    }


    public static function LipaNaMpesaStkPush($amount, $msisdn)
    {   
        $BusinessShortCode = '288888';
        $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
        $PartyA = $msisdn;  
        $AccountReference = $msisdn;
        $TransactionDesc  = 'Payment';
        $Amount = $amount;
        $Timestamp = date('YmdHis');    
        $Timestamp = '20171115120703';    
        $Password = 'Mjg4ODg4MDhiODQwMjFjODA3MmU1OTQ3NGY5ZWI4NDA5NTc1YWRhMjRiMTVhODRmMTliZjBmZDNmNDU4ODQ5ZTAyOWZlODIwMTcxMTE1MTIwNzAz';  
        $initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $CallBackURL = 'http://161.35.6.91/adminhub/app/backend/web/index.php/api/webhook';
        
        $stkheader = [ 
                        'Content-Type:application/json',
                        'Authorization:Bearer '.self::generateOliveAccessToken()
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

        return $stk_result =  json_decode($curl_response);
    }
    

    public static function  TopUpMswaliMpesaStkPush($amount, $msisdn)
    {

        $initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $BusinessShortCode = '735557';
        $PartyA = $msisdn; 
        $AccountReference = $PartyA;
        $TransactionDesc  = 'Dummy transaction';
        $Amount = $amount;
        $Passkey = 'b2b8424f1baacf92dd9bd9314cf1029d27976f7fd2b84fc15a15546d05d811b1';  
        $Timestamp = date('YmdHis');
        $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
        # callback url
        $CallBackURL = 'http://161.35.6.91/adminhub/app/backend/web/index.php/api/webhook';
        # header for stk push
        $stkheader = [
            'Content-Type:application/json',
            'Authorization:Bearer '.self::generateMswaliAccessToken()
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

        return $stk_result =  json_decode($curl_response);
    }


    public static function  MpesaSandboxStkPush($amount, $msisdn)
    {

        $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $BusinessShortCode = '174379';
        $PartyA = $msisdn; 
        $AccountReference = $PartyA;
        $TransactionDesc  = 'Payments';
        $Amount = $amount;
        $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
        $Timestamp = date('YmdHis');
        $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
        # callback url
        $CallBackURL = 'http://161.35.6.91/adminhub/app/backend/web/index.php/api/webhook';
        # header for stk push
        $stkheader = [
            'Content-Type:application/json',
            'Authorization:Bearer '.self::generateSandboxAccessToken()
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

        return $stk_result =  json_decode($curl_response);
    }



}


?>