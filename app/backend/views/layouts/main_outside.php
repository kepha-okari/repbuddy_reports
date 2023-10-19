<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAssetOut;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAssetOut::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div class="row no-gutters flex-row-reverse ht-100v "style="background-color:green">
      <div class="col-md-6 bg-gray-200 d-flex align-items-center justify-content-center">
      
      <?= $content ?>
      </div><!-- col -->
      <div class="col-md-6 bg-br-primary d-flex align-items-center justify-content-center" style="background-color:#F86719">
        <div class="wd-250 wd-xl-450 mg-y-30">
          <div class="signin-logo tx-28 tx-bold tx-white">
            <h1>QULA CMS</h1>
          </div>
          <div class="tx-white-7 mg-b-60"></div>

        </div><!-- wd-500 -->
      </div>
    </div><!-- row -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
