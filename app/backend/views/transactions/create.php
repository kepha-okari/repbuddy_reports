<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Transactions */

$this->title = Yii::t('app', 'Create Transactions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="w0" class="x_panel">
  <div class="">
  <h2><i class="fa "></i> <?= Html::encode($this->title) ?></h2>
  </div>
  </div>
  <div id="w0" class="x_panel">
<div class="transactions-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
