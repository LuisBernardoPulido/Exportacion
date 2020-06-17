<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Upp */

$this->title = 'Editar Unidad: ' . $model->r01_clave;
$this->params['breadcrumbs'][] = ['label' => 'Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->r01_clave, 'url' => ['view', 'id' => $model->r01_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="upp-update">

    <?= $this->render('_form', [
        'model' => $model,
        'relaciones'=>$relaciones,
    ]) ?>

</div>
