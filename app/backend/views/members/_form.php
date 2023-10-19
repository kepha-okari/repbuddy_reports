<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Clients;
use kartik\date\DatePicker;



/* @var $this yii\web\View */
/* @var $model backend\models\Members */
/* @var $form yii\widgets\ActiveForm */
$clientList=ArrayHelper::map(Clients::find()->all(), 'id', 'name');


// if(Yii::$app->user->identity->client_id != 1)//If client not equal to super
// {
//     $clientList=ArrayHelper::map(Clients::find()->where('id ='.Yii::$app->user->identity->client_id)->all(), 'id', 'name');
// }else{

//     $clientList=ArrayHelper::map(Clients::find()->all(), 'id', 'name');
// }
?>

<div class="members-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'identity_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_type')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'loan_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dob')->widget(\kartik\date\DatePicker::classname(), [
        'value' => date('d-M-Y', strtotime('-18 years')),
        'options' => ['placeholder' => 'Select date of birth'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]);
    ?>

    <?=
        $form->field($model, 'client_id')->widget(Select2::classname(), [
            'data' => $clientList,
            'language' => 'en',
            'options' => ['placeholder' => 'Select Client ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'inserted_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
