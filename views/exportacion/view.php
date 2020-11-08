<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Exportacion */

$this->title = $model->p11_id;
$this->params['breadcrumbs'][] = ['label' => 'Exportacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exportacion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->p11_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->p11_id], [
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
            'p11_id',
            'p11_guia',
            'p11_fecha',
            'r01_origen',
            'r01_destino',
            'c01_id',
            'p11_motivo',
            'p11_especie',
            'p11_aux',
            'p11_usuAlta',
            'p11_fecAlta',
            'p11_usuMod',
            'p11_fecMod',
        ],
    ]) ?>

</div>
