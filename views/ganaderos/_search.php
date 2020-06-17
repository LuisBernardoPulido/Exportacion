<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\GanaderosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ganaderos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'c01_id') ?>

    <?= $form->field($model, 'c01_nombre') ?>

    <?= $form->field($model, 'c01_apaterno') ?>

    <?= $form->field($model, 'c01_amaterno') ?>

    <?= $form->field($model, 'c01_curp') ?>

    <?php // echo $form->field($model, 'c01_rfc') ?>

    <?php // echo $form->field($model, 'c01_telefono') ?>

    <?php // echo $form->field($model, 'c01_colonia') ?>

    <?php // echo $form->field($model, 'c01_calle') ?>

    <?php // echo $form->field($model, 'c01_cp') ?>

    <?php // echo $form->field($model, 'c01_localidad') ?>

    <?php // echo $form->field($model, 'c01_municipio') ?>

    <?php // echo $form->field($model, 'c01_estado') ?>

    <?php // echo $form->field($model, 'c01_correo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
