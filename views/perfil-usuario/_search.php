<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\PerfilUsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="perfil-usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'a02_id') ?>

    <?= $form->field($model, 'a01_id') ?>

    <?= $form->field($model, 'a02_nombre') ?>

    <?= $form->field($model, 'a02_apaterno') ?>

    <?= $form->field($model, 'a02_amaterno') ?>

    <?php // echo $form->field($model, 'a02_email') ?>

    <?php // echo $form->field($model, 'a02_telfono') ?>

    <?php // echo $form->field($model, 'a02_direccion') ?>

    <?php // echo $form->field($model, 'a02_activo') ?>

    <?php // echo $form->field($model, 'a02_intentos') ?>

    <?php // echo $form->field($model, 'a02_islab') ?>

    <?php // echo $form->field($model, 'a02_usuAlta') ?>

    <?php // echo $form->field($model, 'a02_fecAlta') ?>

    <?php // echo $form->field($model, 'a02_usuMod') ?>

    <?php // echo $form->field($model, 'a02_fecMod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
