<?php

namespace backend\libraries;
date_default_timezone_set('Africa/Nairobi');

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
use backend\libraries\Notify;
use backend\models\Authentication;
use backend\models\Clients;

/**
* Common functions
*/
class Commons 
{

   //Hash String
   public static function hashString($string='123qwe')
   {
        $string_hash = Yii::$app->security->generatePasswordHash($string);
        return $string_hash;
   }

    //Generate random string
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * Generate random TOTP
     * @param $phone
     * @return string|null $otp 
     */
    public static function generateRandomTOTP($phone) {

        $randomString = mt_rand(1000,9999);
        
        $otp = (int) $randomString;

        $exists = Authentication::find()->where(['phone'=>$phone])->exists();
        
        // upsert
        if($exists){
            \Yii::$app->db->createCommand()
            ->update('authentication', ['otp' => $otp, 'expired' => false], ['phone' => $phone])
            ->execute();
        } else{
            $connection =  \Yii::$app->db;
            $connection->createCommand()->insert('authentication', [
                'phone' => self::formatMSISDN($phone, FALSE),
                'otp' => (int) $randomString
            ])->execute();
        }

        Notify::sendSMS( 'Your OTP is '.$otp, $phone );
        return $otp;
    }


    /**
     * validateTOTP | evaluates the string expiration date
     * @param integer $totp,
     * @param string $phone,
     * @return array 
     */
    public static function validateTOTP($totp, $phone) {

        $credentials = Authentication::find()->where(['phone'=>$phone])->one();

        if(!empty($credentials) && $credentials->otp == $totp){

            $otpStamp = date('Y-m-d H:i:s', strtotime('+3 hour', strtotime($credentials->created_at) )); #compensate 3 hrs as current mysql server is 3 hrs behind 
            
            $accessTimeStamp = date('Y-m-d H:i:s', strtotime('+35 second', strtotime($otpStamp)));

            $currTime = date('Y-m-d H:i:s');

            if( $currTime <= $accessTimeStamp ){

                \Yii::$app->db->createCommand()
                ->update('authentication', ['expired' => true], ['phone' => $phone])
                ->execute();

                return ['status' => true, 'status_message' => 'OTP validated successfully' ];

            } else{

                return [ 'status' => false, 'status_message' => 'otp submited has expired', 'current-time'=> $currTime, 'otp-timestamp'=> $accessTimeStamp];
            }

        } else{
            
            return [ 'status' => false, 'status_message' => 'otp not verified' ];
            
        }

    }




    /**
     * Validate Hash 
     * @param integer $totp,
     * @param string $phone,
     * @return array 
     */    
    public static function validateHash($string,$original_hash) {
        return Yii::$app->security->validatePassword($string, $original_hash);
    }


    /**
     * create a single string by appending the payload
     * items excluding the token and the api_key
     * @param array $payload obtained from url,
     * @return string|null $datastring
     */
    public static function createDataString($payload) {

        $avoid = ['token', 'api_key'];
        $datastring = '';
        foreach ($payload as $key => $val) {
            if(!in_array($key, $avoid)){
                $datastring.=$val;
            }
        }
        return $datastring;
    }


    /**
     * string hashing of the payload
     * @param string $data_string,
     * @param integer $client_id,
     * @return string|null $result or null 
     */
    public static function hashPayload($payload, $client_id) {

        $data_string = self::createDataString($payload);

        $client = Clients::find()->where(['id' => $client_id])->one();

        if( !empty($client) ) {

            $hash = hash_hmac('sha256', $data_string, $client->api_key);

            $result = base64_encode($hash);

            return $result;

        } else {

            return null;
        }

    }


    public static function hashPayload3($payload, $api_key) {

        $data_string = self::createDataString($payload);

        $hash = hash_hmac('sha256', $data_string, $api_key);

        $result = base64_encode($hash);

        return $result;

    }


    /**
     * Compares two hashed string 
     * @param string $client_string, $rebuilt_string
     * @return boolean 
     */
    public static function validateApiCall($client_string, $rebuilt_string) {

        $result = $client_string === $rebuilt_string ? true : false ;        

        return $result;

    }


    /**
     * Formats a phone number into acceptable 
     * @param string $MSISDN,
     * @param integer $international mode,
     * @return string|null $result or null 
     */
    public static function formatMSISDN($MSISDN, $internationalMode = FALSE) {

        // default the country-dial code
        $countryDialCode = 254;
        try {
            //Sanitize the MSISDN
            $formatedMSISDN = preg_replace("/[^0-9\s]/", "", $MSISDN);

            //Get rid of the leading 0
            if ((substr($formatedMSISDN, 0, 1) == "0") && (strlen($formatedMSISDN) == 10)) {
                $formatedMSISDN = substr_replace($formatedMSISDN, "", 0, 1);
            }
            
            // If the # is less than the countries #
            if (strlen($formatedMSISDN) <= 9 && strlen($formatedMSISDN) > 0) {
                $formatedMSISDN = $countryDialCode . $formatedMSISDN;
                // If it is in international mode we apppend a  +
                if ($internationalMode) {
                    $formatedMSISDN = "+" . $formatedMSISDN;
                }
            }
        } catch (Exception $exc) {
            $flogParams = array('MSISDN' => $formatedMSISDN);
            //CoreUtils::flog(2, $flogParams, "Error formating the MSISDN  \n" . $exc->getMessage(), "\n" . __CLASS__, __FUNCTION__, __LINE__);
        }

        return trim($formatedMSISDN);

    }


    /**
     * Function to validate the MSISDN
     *
     */
    public static function isValidMobileNo($userNumber, $format = 'emg') {

        global $err, $descr;
        $numberRule[0] = array('netlen' => 2, 'netNo' => 71, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //safaricom 1
        $numberRule[1] = array('netlen' => 2, 'netNo' => 72, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //safaricom 1
        $numberRule[2] = array('netlen' => 2, 'netNo' => 73, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //celtel
        $numberRule[3] = array('netlen' => 2, 'netNo' => 75, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //Yu
        $numberRule[4] = array('netlen' => 2, 'netNo' => 77, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //Orange
        $numberRule[5] = array('netlen' => 2, 'netNo' => 20, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //telcom

        $numberRule[6] = array('netlen' => 2, 'netNo' => 71, 'prefix' => 255, 'intprefix' => '+255', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //TZ Tigo
        $numberRule[7] = array('netlen' => 2, 'netNo' => 78, 'prefix' => 255, 'intprefix' => '+255', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //TZ Zain
        $numberRule[8] = array('netlen' => 2, 'netNo' => 75, 'prefix' => 255, 'intprefix' => '+255', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //TZ Vodacom
        $numberRule[9] = array('netlen' => 2, 'netNo' => 77, 'prefix' => 255, 'intprefix' => '+255', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //TZ Zantel
        $numberRule[10] = array('netlen' => 2, 'netNo' => 73, 'prefix' => 255, 'intprefix' => '+255', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //TZ TTLC
        $numberRule[11] = array('netlen' => 2, 'netNo' => 79, 'prefix' => 255, 'intprefix' => '+255', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //TZ Benson Online

        $numberRule[12] = array('netlen' => 1, 'netNo' => 7, 'prefix' => 256, 'intprefix' => '+256', 'localprefix' => '0', 'userlen' => 8, 'numlen' => 12); //UG numbers
        $numberRule[13] = array('netlen' => 2, 'netNo' => 70, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); // safaricom
        $numberRule[14] = array('netlen' => 1, 'netNo' => 2, 'prefix' => 233, 'intprefix' => '+233', 'localprefix' => '0', 'userlen' => 8, 'numlen' => 12);  // Ghana numbers

        $numberRule[15] = array('netlen' => 2, 'netNo' => 97, 'prefix' => 260, 'intprefix' => '+260', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); // Zambia numbers
        $numberRule[16] = array('netlen' => 2, 'netNo' => 96, 'prefix' => 260, 'intprefix' => '+260', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); // Zambia numbers
        $numberRule[17] = array('netlen' => 2, 'netNo' => 70, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); // safaricom
        $numberRule[18] = array('netlen' => 2, 'netNo' => 78, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); //celtel
            $numberRule[19] = array('netlen' => 2, 'netNo' => 79, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); // safaricom
        $numberRule[20] = array('netlen' => 2, 'netNo' => 76, 'prefix' => 254, 'intprefix' => '+254', 'localprefix' => '0', 'userlen' => 7, 'numlen' => 12); // equitel

        $userNumber = 0 + str_replace(' ', '', $userNumber);
        $len = strlen($userNumber);
        $mobileNumber = 0;
        $netNo = 0;

        //CoreUtils::flog2('DEBUG', "THE USER NUMBER => $userNumber", __FILE__, __FUNCTION__, __LINE__);
        //find country with the lowest prefix, and use it as the "minimum mobile number"
        $minPrefix = $numberRule[0]['prefix'];
        $maxPrefix = $numberRule[0]['prefix'];
        foreach ($numberRule as $nm) {
            if ($nm['prefix'] < $minPrefix) {
                $minPrefix = $nm['prefix'];
            }
            if ($nm['prefix'] > $maxPrefix) {
                $maxPrefix = $nm['prefix'];
            }
        }
        $leastUserNumber = $minPrefix * 1000000000;
        $maxUserNumber = ($maxPrefix * 1000000000) + 999999999;
        //        if ($userNumber > 0 and $userNumber < 269999999999) {
        if ($userNumber > $leastUserNumber and $userNumber < $maxUserNumber) {
            //CoreUtils::flog2('DEBUG', "THE USER NUMBER => $userNumber is of required length.", __FILE__, __FUNCTION__, __LINE__);

            $myRule = null;
            foreach ($numberRule as $rule) {
                $upperNet = 0;
                $netOK = true;
                $xs = $rule['userlen'] + $rule['netlen'];

                //CoreUtils::flog2('DEBUG', "The total length is=> $xs", __FILE__, __FUNCTION__, __LINE__);
                //CoreUtils::flog2('DEBUG', "The total length is=> $len", __FILE__, __FUNCTION__, __LINE__);

                if ($len < $xs) {
                    $err .= "$userNumber - [ len:$len < valid:$xs] ";
                    $descr = "INVALID:$userNumber too short";
                    continue;
                }

                $mobileNumber = 0 + substr($userNumber, (-1 * $xs), $xs);

                //CoreUtils::flog2('DEBUG', "The mobileNumber => $mobileNumber", __FILE__, __FUNCTION__, __LINE__);

                $netNo = 0 + substr($userNumber, (-1 * $xs), $rule['netlen']);

                //CoreUtils::flog2('DEBUG', "The netNo => $netNo", __FILE__, __FUNCTION__, __LINE__);

                if ($len >= $xs) {
                    $netOK = false;
                    $lx = $len - $xs;
                    if ($lx > 0) {
                        $upperNet = 0 + substr($userNumber, (-1 * ($lx + $xs)), $lx);
                    } else {
                        $upperNet = 0;
                    }
                    if ($upperNet == 0 or $upperNet == $rule['prefix'] or $upperNet == $rule['netNo'] or $upperNet == $rule['localprefix'] or $upperNet == $rule['intprefix'])
                        $netOK = true;
                }
                //$err .= "<br/> un:$userNumber, mn:$mobileNumber, net:$netNo upp:$upperNet ln:$len ".printArray($rule);

                if ($netNo == $rule['netNo'] and $netOK) {
                    $myRule = $rule;
                    break;
                }
            }

            if (is_null($myRule)) {
                $err .= "$userNumber - network:'$netNo' or prefix:'$upperNet' not acceptable";
                $descr = "INVALID:$userNumber not a valid network";
                return 0;
            }

            // i have a number and details
            switch ($format) {

                case 'int':
                case 'international':
                    $number = $myRule['intprefix'] . $mobileNumber;
                    break;
                case 'local':
                    $number = $myRule['localprefix'] . $mobileNumber;
                    break;
                default: // emg
                    $number = $myRule['prefix'] . $mobileNumber;
                    break;
            }
            return $number;
        } elseif ($userNumber == 0) {
            $err .= "'$mobileNumber' not numeric";
            $descr = "INVALID:$mobileNumber not a number";
            return 0;
        }

        $err .= "'$mobileNumber' not within given range";
        $descr = "INVALID:$mobileNumber not within given range";
        return 0;
    }


    public static function confirmation() {
    
        if (!isset($_SESSION)) {
            session_cache_limiter('private, must-revalidate');
            session_cache_expire(60);
            session_start();
        } else {
            session_reset();
        }
    
        $Amount = null;
        $MpesaReceiptNumber = null;
        $TransactionDate = null;
        $PhoneNumber = null;
        $phonefriend = null;
    
        $fnx = null;
    
        $phonefriend = $_SESSION['phonefriend'];
        
        // echo "Callback URL hit \n";
        // $postData = file_get_contents('php://input');
    
        $postData ='{"TransactionType": "Customer Merchant Payment","TransID": "PH85DLFPD3","TransTime": "20210808204334","TransAmount": "1.00","BusinessShortCode": "515021","BillRefNumber": "","InvoiceNumber": "","OrgAccountBalance": "102.00","ThirdPartyTransID": "","MSISDN": "254721619818","FirstName": "KENNEDY","MiddleName": "OTIENO","LastName": "OTIENO"}';
        
        
    
        if (strpos($postData, 'TransactionType') !== false) {
            echo "Here in main";
    
            $array = json_decode($postData, true);
    
            $Amount = $array['TransAmount'];
            $MpesaReceiptNumber = $array['TransID'];
            $TransactionDate = $array['TransTime'];
            $PhoneNumber = $array['MSISDN'];
            $type = "PAYG";
    
        }else{
    
            echo "Here in else";
    
            $posted = json_decode($postData);
    
            $MerchantRequestID = $posted->Body->stkCallback->MerchantRequestID;
            $CheckoutRequestID = $posted->Body->stkCallback->CheckoutRequestID;
            $ResultCode = $posted->Body->stkCallback->ResultCode;
            $ResultDesc = $posted->Body->stkCallback->ResultDesc;
    
    
            if ($ResultCode == 0) {
    
                
                //Get the Metadata
                $items = $posted->Body->stkCallback->CallbackMetadata->Item;
    
                foreach ($items as $key => $value) {
                    if ($value->Name == 'Amount') {
                        $Amount = $value->Value;
                    }
    
                    if ($value->Name == 'MpesaReceiptNumber') {
                        $MpesaReceiptNumber = $value->Value;
                    }
    
                    if ($value->Name == 'TransactionDate') {
                        $TransactionDate = $value->Value;
                    }
    
                    if ($value->Name == 'PhoneNumber') {
                        $PhoneNumber = $value->Value;
                    }
                }
            }
        }
    
            
    
        $uptime = getUptime($Amount);
    
        $profile = getProfile($Amount);
    
        $phone = getPhone($PhoneNumber);
    
        //write response details to DB
        $servername = "localhost";
        $username = "root";
        // $password = "M@nt1c0r3";
        // $password = "root";
        $password = "#@1ewqDSA";
        $dbname = "phpmixbill";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            
    
            die("Connection failed: " . $conn->connect_error);
        }
    
        $sql = "INSERT INTO tbl_mpesa_payments (amount, MpesaReceiptNumber, TransactionDate, phonenumber, friendphone, type, response)
        VALUES ('$Amount','$MpesaReceiptNumber','$TransactionDate','$PhoneNumber','$phonefriend','$type','$postData')";
    
        if ($conn->query($sql) === true) {
            // echo "New record created successfully";
    
            
    
            //call function to create user in router
            createHotspotUser($phone, $uptime, $profile, $phonefriend, $fxn);
    
        } else {
            echo "Error: " . $conn->error;
        }
    
        $conn->close();
    
        
    
    }


    public static function groupRecordsByDate($transaction_records){
        // Group transaction records by date
        $records_by_date = [];
        foreach ($transaction_records as $record) {
            $date = date('Y-m-d', strtotime($record['inserted_at']));
            $records_by_date[$date][] = $record;
        }

        // Find total amount for each day
        $daily_totals = [];
        foreach ($records_by_date as $date => $records) {
            $total = 0;
            foreach ($records as $record) {
                if ($record['amount'] !== null) {
                    $total += (float) $record['amount'];
                }
            }
            $daily_totals[] = [
                'date' => $date,
                'total' => $total,
            ];
        }


        return $daily_totals;

    }


    public static function aggregateTotalsByDay($data) {
        $totals = array();
        
        // Get the current date
        $today = date('Y-m-d');
        
        // Iterate over the last seven days
        for ($i = 0; $i < 7; $i++) {
            // Calculate the date for the current iteration
            $date = date('Y-m-d', strtotime("-$i day", strtotime($today)));
            
            // Initialize the total for the current date to zero
            $total = 0;
            
            // Iterate over the data and sum the amounts for the current date
            foreach ($data as $entry) {
                if ($entry['status'] === 'CLOSED' && substr($entry['inserted_at'], 0, 10) === $date) {
                    $total += intval($entry['amount']);
                }
            }
            
            // Store the total for the current date in the result array
            $totals[$date] = $total;
        }
        
        // Sort the totals array in descending order based on values
        ksort($totals);
        
        return $totals;
    }
    
}

