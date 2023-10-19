<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Clients;
use backend\models\Members;


// /* @var $this yii\web\View */
// /* @var $model backend\models\Accounts */
// /* @var $form yii\widgets\ActiveForm */

$clientList=ArrayHelper::map(Clients::find()->all(), 'id', 'name');
$memberList=ArrayHelper::map(Members::find()->all(), 'id', 'first_name');


?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'balance')->textInput() ?>

    <?= $form->field($model, 'debit')->textInput() ?>

    <?= $form->field($model, 'credit')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?=
        $form->field($model, 'client_id')->widget(Select2::classname(), [
            'data' => $clientList,
            'language' => 'en',
            'options' => ['placeholder' => 'Select Sacco ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?=
        $form->field($model, 'member_id')->widget(Select2::classname(), [
            'data' => $memberList,
            'language' => 'en',
            'options' => ['placeholder' => 'Select Member ...'],
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
