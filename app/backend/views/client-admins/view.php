<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ClientAdmins */

$this->title = 'View client-admins ';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Client Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="w0" class="x_panel">
  <div class="">
  <h2><i class="fa fa-users"></i> View client-admins : <?= Html::encode($this->title) ?></h2>
  </div>
  </div>

 <div id="w0" class="x_panel">
<div class="client-admins-view">

    <p class="pull-right">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'names',
            'msisdn',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'client_id',
            'status',
            'created_by',
            'updated_by',
            'inserted_at',
            'updated_at',
        ],
    ]) ?>

</div>
</div>
