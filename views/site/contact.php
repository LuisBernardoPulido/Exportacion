<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'Contacto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Contáctanos</div>
    <div class="panel-body"  style="background-color: #ECECEC">
<div class="site-contact">

<div class="conactous">
    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Gracias. Nos pondremos en contacto lo antes posible.
        </div>
        <br>
        <div class="form-group" style="text-align:center;">

            <a href='index.php?r=site/contact' role="button"><?= Html::button('Regresar', ['class' => 'btn btn-primary button_crear', 'title' => "Regresar"]) ?></a>

        </div>


        <p>
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                                                                                                    Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6" style="margin-top: 5%; ">

                <p>
                    Si tiene alguna pregunta relacionada al funcionamiento del sistema o algún comentario del mismo, favor de llenar el siguiente formulario
                    para ponerse en contacto con nosotros. Gracias.
                </p>

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
<br>
                <div class="form-group" style="text-align:center;">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary button_crear', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-lg-3">
            </div>
        </div>
</div>
    <?php endif; ?>
</div>
</div>
</div>