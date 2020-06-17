<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->registerCssFile('css/style_mpc.css');

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '¡Bienvenido a SIFOPE!';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#" id="negritas"><b>SI</b>FOPE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body login-box-back">
        <p class="login-box-msg">Ingresa tus datos de acceso</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox()->label('Mantener la sesión iniciada') ?>
            </div>

            <!-- /.col -->

            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-xs-2"></div>
            <div class="col-xs-8" style="alignment: center;">
                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <div class="col-xs-2"></div>
        </div>


        <?php ActiveForm::end(); ?>

       <!-- <div class="social-auth-links text-center">
            <p>- O -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in
                using Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign
                in using Google+</a>
        </div>-->
        <!-- /.social-auth-links -->

       <p style="text-align: center; border-bottom: 0px; margin-top: 10px;"> <a href="#" >¿Olvidaste tu contraseña?</a></p><br>


    </div>
    <br>
    <?php
    $value = Yii::$app->session->getFlash('error', '0');
    if($value!='0'){
        ?>
        <div class="alert alert-danger fade in"><?= Yii::$app->session->getFlash('error') ?></div>
    <?php
    }
    ?>

    <!-- /.login-box-body -->

</div><!-- /.login-box -->