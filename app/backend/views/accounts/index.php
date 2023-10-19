<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="w0" class="x_panel">
  <div class="">
  <h2><i class="fa "></i> Manage <?= Html::encode($this->title) ?></h2>
  </div>
  </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div id="w0" class="x_panel">
<div class="accounts-index">

    <p>
        <?= Html::a(Yii::t('app', '<i class=\"fa fa-plus\"></i> Create Accounts'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
        <div class="clearfix"></div>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'balance',
            'debit',
            'credit',
            'type',
            'client_id',
            'member_id',
            'inserted_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn','template'=>'{view}{update}{delete}'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>