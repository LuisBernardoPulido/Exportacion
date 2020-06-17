<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\UppSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="upp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'r01_id') ?>

    <?= $form->field($model, 'r01_nombre') ?>

    <?= $form->field($model, 'r01_superficie') ?>

    <?= $form->field($model, 'r01_clave') ?>

    <?= $form->field($model, 'r01_localidad') ?>

    <?php // echo $form->field($model, 'r01_municipio') ?>

    <?php // echo $form->field($model, 'r01_estado') ?>

    <?php // echo $form->field($model, 'r01_faretado') ?>

    <?php // echo $form->field($model, 'r01_tenencia') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
