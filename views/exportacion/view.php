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
