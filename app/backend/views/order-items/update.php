<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderItems */

$this->title = Yii::t('app', 'Update Order Items: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div id="w0" class="x_panel">
  <div class="">
  <h2><i class="fa "></i> <?= Html::encode($this->title) ?></h2>
  </div>
  </div>

  <div id="w0" class="x_panel">
<div class="Order Items-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
