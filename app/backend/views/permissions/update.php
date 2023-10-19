<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Permissions */

$this->title = 'Update Permissions: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div id="w0" class="x_panel">
  <div class="">
  <h2><i class="fa "></i> <?= Html::encode($this->title) ?></h2>
  </div>
  </div>

  <div id="w0" class="x_panel">
<div class="permissions-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
