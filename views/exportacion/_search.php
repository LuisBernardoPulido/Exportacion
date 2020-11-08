<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ExportacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exportacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'p11_id') ?>

    <?= $form->field($model, 'p11_guia') ?>

    <?= $form->field($model, 'p11_fecha') ?>

    <?= $form->field($model, 'r01_origen') ?>

    <?= $form->field($model, 'r01_destino') ?>

    <?php // echo $form->field($model, 'c01_id') ?>

    <?php // echo $form->field($model, 'p11_motivo') ?>

    <?php // echo $form->field($model, 'p11_especie') ?>

    <?php // echo $form->field($model, 'p11_aux') ?>

    <?php // echo $form->field($model, 'p11_usuAlta') ?>

    <?php // echo $form->field($model, 'p11_fecAlta') ?>

    <?php // echo $form->field($model, 'p11_usuMod') ?>

    <?php // echo $form->field($model, 'p11_fecMod') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
