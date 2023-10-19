<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Status;
use backend\models\Clients;
/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */


//Get status
$statusList=ArrayHelper::map(Status::find()->limit(2)->all(), 'id', 'status');
$clientList=ArrayHelper::map(Clients::find()->all(), 'id', 'name');
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
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => [
          'data-pjax' => 1
        ],
      ]); ?>
      
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-6">
          <?= $form->field($model, 'names') ?>
        </div>
        <div class="col-md-3">
          <?= $form->field($model, 'msisdn') ?>
        </div>
        <div class="col-md-3">
          <?= 
            $form->field($model, 'client_id')->widget(Select2::classname(), [
              'data' => $clientList,
              'language' => 'en',
              'options' => ['placeholder' => 'Select Status ...'],
              'pluginOptions' => [
                  'allowClear' => true
              ],
            ]);          
          ?>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="col-md-6">
          <?= $form->field($model, 'email') ?>
        </div>
        <div class="col-md-6">
        <?php
              echo $form->field($model, 'status')->widget(Select2::classname(), [
                  'data' => $statusList,
                  'language' => 'en',
                  'options' => ['placeholder' => 'Select Status ...'],
                  'pluginOptions' => [
                      'allowClear' => true
                  ],
              ]);
          ?>
        </div>
      </div>
    </div>

    <div class="form-group pull-right">
      <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
      <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>
