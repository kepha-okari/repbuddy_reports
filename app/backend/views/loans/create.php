<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Loans */

$this->title = Yii::t('app', 'Create Loans');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="w0" class="x_panel">
  <div class="">
  <h2><i class="fa "></i> <?= Html::encode($this->title) ?></h2>
  </div>
  </div>
  <div id="w0" class="x_panel">
<div class="loans-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
