<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PerfilUsuario */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Datos de usuario</div>
    <div class="panel-body">
        <div class="perfil-usuario-form">

            <?php $form = ActiveForm::begin(); ?>
            <!--
            <h4>Datos de usuario</h4>
            <hr style="border-top: 1px solid #D5D5D5; margin-top: 0px;"/>
            -->
            <div id="errores_val" class="<?=strlen($msg)>0 ? 'alert alert-danger' : ''?> help-block"><?=$msg?></div>
               <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <?= $form->field($modelUser, "username" )->textInput(['maxlength' => true , Yii::$app->user->can('/admin/*')? "":'readonly'=>true])?>
                    </div>
                   <div class="col-md-3 col-sm-3">
                       <?= $form->field($modelUser, "password")->input("password") ?>
                   </div>

                   <div class="col-md-3 col-sm-3">
                       <?= $form->field($modelUser, "password_repeat")->input("password") ?>
                   </div>
               </div>

                <div class="clearfix visible-sm-block"></div>

            <!--
            <h4>Datos personales</h4>
            <hr style="border-top: 1px solid #D5D5D5; margin-top: 0px;"/>
            -->
            <div class="row">
                <div class="col-md-3">
                   <?= $form->field($model, 'a02_nombre')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                   <?= $form->field($model, 'a02_apaterno')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                   <?= $form->field($model, 'a02_amaterno')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <?= $form->field($modelUser, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'a02_telfono')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                   <?= $form->field($model, 'a02_direccion')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row <?= Yii::$app->user->can('/admin/*')? "":(Yii::$app->user->can('/perfilusuario/update')?"":"hidden") ?>">
                <div class="col-md-3">
                    <?= $form->field($model, 'a02_activo')->dropDownList(['1'=>'ACTIVO', '0'=>'INACTIVO'], ['autofocus'=>true]) ?>
                </div>
            </div>

            <br>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-primary button_crear' : 'btn btn-primary button_crear']) ?>
            </div>


            <?php ActiveForm::end(); ?>


        </div>

    </div>
</div>
