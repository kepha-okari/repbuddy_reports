<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\IncomingPaymentLogs */

$this->title = Yii::t('app', 'Create Incoming Payment Logs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incoming Payment Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="w0" class="x_panel">
  <div class="">
  <h2><i class="fa "></i> <?= Html::encode($this->title) ?></h2>
  </div>
  </div>
  <div id="w0" class="x_panel">
<div class="incoming-payment-logs-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
