<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\IncomingPaymentLogs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incoming-payment-logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'msisdn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'merchant_request_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checkout_request_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'response_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'response_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'result_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'result_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mpesa_receipt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inserted_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
