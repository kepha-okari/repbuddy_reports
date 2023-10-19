<?php

namespace backend\libraries;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
use backend\models\UserGroups;
use backend\models\Permissions;
use backend\libraries\Statuses;
/**
* RBAC functions
*/
class RBAC 
{
    //Default Client
    const super_client = 1; //Super Client
    //Permissions
    const omnipotent=1; //Can do all things
    const manage_clients=2; //Manage clients
    const manage_users=3; //Manage users
    const manage_actions=4; //Manage Actions
    const manage_permissions=5; //Manage Permissions
    const manage_user_groups=6; //Manage User Groups
    const manage_groups=7; //Manage Groups
    const manage_notifications=8; //Manage Notifications
    const view_user_audits=9;//View User Audits

    const manage_loans=10;
    const manage_products=11;
    const manage_categories=11;
    const manage_orders=11;
    const manage_orderitems=11;
    const manage_incomingpaymentlogs =11;

    const admin_group = 2; // Default Group
    const super_admin_user = 2; 
    const manage_members = 12; 
    const manage_accounts = 12; 
    const manage_ledgers = 12; 
    const manage_transactions = 12; 
    const manage_clientadmins = 12; 

   //Get user permissions
   public static function getPermissions($user_id)
   {
        $actionsList=NULL;
        $actionsArray = array();
        //Get user groups
        $groupsList=ArrayHelper::map(UserGroups::find()->where(['status'=>Statuses::ACTIVE,'user_id'=>$user_id])->all(), 'id', 'group_id');

        //Get the actions
        foreach($groupsList as $id => $group_id)
        {
          //Get the permissions for that group
          $actionsList=ArrayHelper::map(Permissions::find()->where(['status'=>Statuses::ACTIVE,'group_id'=>$group_id])->all(), 'id', 'action_id');

          foreach($actionsList as $id => $action_id){
            array_push($actionsArray,$action_id);
          }

        }

        Yii::$app->session['allowed_actions'] = $actionsArray;
        return $actionsArray;
   }


    //Check if user has rights
    public static function can($action_id)
    {
      
        if(!isset(Yii::$app->session['allowed_actions']))
        {
          return FALSE;
        }

        //Check if user has omnipotent permission
        if (in_array(RBAC::omnipotent, Yii::$app->session['allowed_actions'])) {

          return TRUE;

        }elseif(in_array($action_id, Yii::$app->session['allowed_actions']))
        {
          return TRUE;

        }else{

          return FALSE;

        }
    }

}

?>