<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\IncomingPaymentLogs */

$this->title = 'View incoming-payment-logs ';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incoming Payment Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="w0" class="x_panel">
  <div class="">
  <h2><i class="fa fa-users"></i> View incoming-payment-logs : <?= Html::encode($this->title) ?></h2>
  </div>
  </div>

 <div id="w0" class="x_panel">
<div class="incoming-payment-logs-view">

    <p class="pull-right">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'msisdn',
            'order_id',
            'merchant_request_id',
            'checkout_request_id',
            'response_code',
            'response_desc',
            'customer_message',
            'result_code',
            'result_desc',
            'amount',
            'mpesa_receipt',
            'transaction_date',
            'client_id',
            'status',
            'inserted_at',
            'updated_at',
        ],
    ]) ?>

</div>
</div>
