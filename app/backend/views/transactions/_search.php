<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransactionSearch */
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

<div class="transactions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reference_code') ?>

    <?= $form->field($model, 'transaction_type') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'payment_gateway') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'member_id') ?>

    <?php // echo $form->field($model, 'inserted_at') ?>

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
