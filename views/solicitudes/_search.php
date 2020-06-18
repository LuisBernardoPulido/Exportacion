<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SolicitudesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitudes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'p09_id') ?>

    <?= $form->field($model, 'p09_referencia') ?>

    <?= $form->field($model, 'r01_id') ?>

    <?= $form->field($model, 'p09_usuAlta') ?>

    <?= $form->field($model, 'p09_fecAlta') ?>

    <?php // echo $form->field($model, 'p09_usuMod') ?>

    <?php // echo $form->field($model, 'p09_fecMod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
