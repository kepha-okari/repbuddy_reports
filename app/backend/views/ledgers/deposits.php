<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LedgerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ledgers';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Total Funds Deposited</span>
            <span class="info-box-number"> <span style="font-size: 20px">Kshs.</span>  <?= $all_time_deposits ?></span>
        </div>
        <!-- /.info-box-content -->
    </div>
        <!-- /.info-box -->
</div>


<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Total Deposited in the past 30 days</span>
            <span class="info-box-number"><span style="font-size: 20px">Kshs.</span> <?= $deposits_this_month ?></span>
        </div>
        <!-- /.info-box-content -->
    </div>
        <!-- /.info-box -->
</div>


<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Total Deposited this week</span>
            <span class="info-box-number"><span style="font-size: 20px">Kshs.</span> <?= $deposits_this_week ?></span>
        </div>
        <!-- /.info-box-content -->
    </div>
        <!-- /.info-box -->
</div>


<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Total Deposited Today</span>
            <span class="info-box-number"><span style="font-size: 20px">Kshs.</span> <?= $deposits_today ?></span>
        </div>
        <!-- /.info-box-content -->
    </div>
        <!-- /.info-box -->
</div>



<div class="ledgers-index">
    <h1><?= Html::encode($header) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // [
            //     'attribute' => 'debit',
            //     'label' => 'Running Balance',
            //     'value' => function ($model) {
            //         if ($model->debit) 
            //         {
            //             return $model->debit;
            //         } else {
            //             return $model->debit;
            //         }
            //     }
            // ],
            // 'transaction_id',
            
            'inserted_at',

            'amount',
            
            [
                'attribute' => 'profile_id',
                'label' => 'Username',
                'value'     => 'profile.name' 
            ],

                     
            [
                'attribute' => 'profile_id',
                'label' => 'Phone Number',
                'value'     => 'profile.account_number'
            ],


            [
                'class' => 'yii\grid\ActionColumn',

                'template' => '{view}',
                'buttons' => [
                    'view'=>function ($url) {
                        return Html::a('', $url, ['class' => 'glyphicon glyphicon-eye-open btn btn-default btn-xs custom_button']);
                    },
                ],

            ],
            

        ],
    ]); ?>


</div>
