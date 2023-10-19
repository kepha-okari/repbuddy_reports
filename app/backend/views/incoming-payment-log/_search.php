<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\IncomingPaymentLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="x_panel">
  <div class="x_title">
    <h2> 
      <i class="fa fa-search">
      </i> Search 
    </h2>
    <ul class="nav navbar-right panel_toolbox">
      <li>
        <a class="collapse-link">
          <i class="fa fa-chevron-up">
          </i>
        </a>
      </li>
      <li>
        <a class="close-link">
          <i class="fa fa-close">
          </i>
        </a>
      </li>
    </ul>
    <div class="clearfix">
    </div>
  </div>
  <div class="x_content">

<div class="incoming-payment-logs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'msisdn') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'merchant_request_id') ?>

    <?= $form->field($model, 'checkout_request_id') ?>

    <?php // echo $form->field($model, 'response_code') ?>

    <?php // echo $form->field($model, 'response_desc') ?>

    <?php // echo $form->field($model, 'customer_message') ?>

    <?php // echo $form->field($model, 'result_code') ?>

    <?php // echo $form->field($model, 'result_desc') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'mpesa_receipt') ?>

    <?php // echo $form->field($model, 'transaction_date') ?>

    <?php // echo $form->field($model, 'client_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'inserted_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="row">
      <div class="col-md-12">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
        </div>
      </div>
    </div>

    <div class="form-group pull-right">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
