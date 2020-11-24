<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitudesExportaciones */

$this->title = 'Update Solicitudes Exportaciones: ' . $model->p12_id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes Exportaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->p12_id, 'url' => ['view', 'id' => $model->p12_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="solicitudes-exportaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
