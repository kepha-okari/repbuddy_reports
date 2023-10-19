<?php

namespace backend\libraries;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;

use backend\models\Notifications;
/**
* Notifications
*/
class Notify 
{

  //Access Message
  const access_message = 'The requested page does not exist or you do not have sufficient rights to access it.';

  //New Registration Notification
  public static function registration_notification($account_name,$account_email,$admin_msisdn,$admin_email,$admin_name,$client_id)
  {
    //send email
    $subject=Yii::$app->name." Registration Notification";
    $message='Hi '.$admin_name.' ,<br/>
              Your '.Yii::$app->name.' account has has been processed. Details are listed below :<br/><br/>
              
              Account Name : '.$account_name.'<br/>
              Account Email: '.$account_email.'<br/>
              Account Phone: '.$admin_msisdn.'<br/><br/>

              Admin User Name  : '.$admin_name.'<br/>
              Admin User Phone : '.$admin_msisdn.'<br/>
    <br/>';


    $result = Notify::create_notifications($admin_email,$admin_msisdn,$message,$subject,$client_id);

    return $result;
  }

  //Password Reset Notification
  public static function password_forgot_notification($token,$email,$msisdn,$client_id)
  {

    //send email
    $subject=Yii::$app->name." Forgot Password Notification";
    $message='Hi ,<br/>
        Your '.Yii::$app->name.' account password recovery request has been processed. Kindly Follow the below link to complete your password recovery.<br/><br/>
        Link:<a href="'.Yii::$app->params['base_url'].'/site/recover-password?&email='.$email.'&token='.$token.'">Password Recover Link</a>
    <br/>';


    $result = Notify::create_notifications($email,$msisdn,$message,$subject,$client_id);

    return $result;

  }

  public static function create_notifications($email,$msisdn,$message,$subject,$client_id)
{
      
      //Insert into notifications
      $notify = new Notifications();
      $notify->email = $email;
      $notify->msisdn = $msisdn;
      $notify->message = $message;
      $notify->subject = $subject;
      $notify->client_id = $client_id;
      $notify->status = Statuses::ACTIVE;

      if($notify->save())
      {
        return TRUE;
      }else{
        return FALSE;
      }

  }


  public static function sendSMS( $message, $msisdn ) {
        
      $url = 'http://167.172.14.50:4002/v1/send-sms';

      // $post_data = http_build_query([
      //     "apiClientID" => 566,
      //     "key" => 'HUuZxgpnOGPTIYF',
      //     "secret" => 'nyailJsfK5r1UPkreVa9xSQH1PDICQ',
      //     "txtMessage" => $message,
      //     "MSISDN" => $msisdn,
      //     "serviceID" => 1
      // ]);
      
      $post_data = http_build_query([
        "apiClientID" => 92,
        "key" => 'OnwyU5jV6dIb225',
        "secret" => 'n0WqOyhKsx2HiMAIcU5ag4A2zJsPej',
        "txtMessage" => $message,
        "MSISDN" => $msisdn,
        "serviceID" => 1
    ]);

      try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded '));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

        $result = json_decode($result);
      
        return $result; 

      } catch (\Throwable $th) {
        throw $th;
      }
  }

  
  /**
    * Format a Kenyan phone number in the format 254XXXXXX.. 
    * using substr() and php regex
    * @param $msisdn
    * @return string
  */
	public static function formatMSISDN($msisdn){

    # format msisdn to 254xxxxx
  $msisdn = (substr($msisdn, 0, 1) == "+") ? str_replace("+", "", $msisdn) : $msisdn;
  $msisdn = (substr($msisdn, 0, 1) == "0") ?  preg_replace("/^0/", "254", $msisdn) : $msisdn;
  $msisdn = (substr($msisdn, 0, 1) == "7") ? "254{$msisdn}" : $msisdn;
  $msisdn = (substr($msisdn, 0, 1) == "1") ? "254{$msisdn}" : $msisdn;
  $msisdn = str_replace(" ", "", $msisdn);

 return $msisdn;
}

}

?>