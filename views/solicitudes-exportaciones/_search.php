<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SolicitudesExportacionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitudes-exportaciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'p12_id') ?>

    <?= $form->field($model, 'p12_sexo') ?>

    <?= $form->field($model, 'p12_aux') ?>

    <?= $form->field($model, 'p12_aux2') ?>

    <?= $form->field($model, 'p12_usuAlta') ?>

    <?php // echo $form->field($model, 'p12_fecAlta') ?>

    <?php // echo $form->field($model, 'p12_usuMod') ?>

    <?php // echo $form->field($model, 'p12_fecMod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
