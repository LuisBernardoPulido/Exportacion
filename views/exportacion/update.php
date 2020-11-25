<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Exportacion */

$this->title = 'Editar Ingreso: ' . $model->p11_id;
$this->params['breadcrumbs'][] = ['label' => 'Exportacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->p11_id, 'url' => ['view', 'id' => $model->p11_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exportacion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
