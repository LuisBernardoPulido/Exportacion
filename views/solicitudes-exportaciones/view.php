<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitudesExportaciones */

$this->title = $model->p12_id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes Exportaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitudes-exportaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->p12_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->p12_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'p12_id',
            'p12_sexo',
            'p12_aux',
            'p12_aux2',
            'p12_usuAlta',
            'p12_fecAlta',
            'p12_usuMod',
            'p12_fecMod',
        ],
    ]) ?>

</div>
