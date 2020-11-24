<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SolicitudesExportaciones */

$this->title = 'Solicitudes';
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes de exportación', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitudes-exportaciones-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
