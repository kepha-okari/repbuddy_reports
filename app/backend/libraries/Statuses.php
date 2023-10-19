<?php

namespace backend\libraries;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;


/**
* Statuses
*/
class Statuses 
{

    // Statuses
	const ACTIVE=1;
	const INACTIVE=2;
	const SUCCESS=5;
	const PENDING='PENDING';
	const APPROVED='APPROVED';
	const SETTLED='SETTLED';
	const PERFORMING='PERFORMING';
	const REJECTED='REJECTED';
	const DEFAULTED='DEFAULTED';

	// Change the choices	
	const ORDER_PENDING=1;
	const ORDER_PAID=2;
	const ORDER_PREPARING=3;
	const ORDER_READY=4;
	const ORDER_DELIVERING=5;
	const ORDER_COMPLETED=6;
	const ORDER_CANCELLED=7;

}

?>