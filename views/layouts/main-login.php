<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
$this->registerCssFile('css/style_mpc.css');

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/divergetica_logo.png" type="image/png"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-page login-test" id="login">

<?php $this->beginBody() ?>
    <?= $content ?>
<!--Logos-->
<div class="raw-logos" style="">
    <div class="col-xs-3">
        <img class="logo_login img-responsive" src="images/SINIIGA.png" alt="" style="margin:6% auto;">
    </div>
    <div class="col-xs-3">
        <img class="logo_login img-responsive" src="images/gobiernoestado.png" alt="" style="margin:6% auto;">
    </div>
    <div class="col-xs-3">
        <img class="secampo_login img-responsive" src="images/SECAMPO.png" alt="" style="margin:10% auto;">
    </div>
    <div class="col-xs-3">
        <img class="cefopp_login img-responsive" src="images/CEFOPP.png" alt="" style="margin:10% auto;">
    </div>
</div>

<?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>
