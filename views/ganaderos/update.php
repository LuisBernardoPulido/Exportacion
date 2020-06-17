<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ganaderos */

$this->title = 'Editar Productor: ' . $model->c01_nombre ." ".$model->c01_apaterno." ".$model->c01_amaterno;
$this->params['breadcrumbs'][] = ['label' => 'Productores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->c01_nombre." ".$model->c01_apaterno, 'url' => ['view', 'id' => $model->c01_id]];
$this->params['breadcrumbs'][] = 'Guardar';
?>
<div class="ganaderos-update">


    <?= $this->render('_form', [
        'model' => $model,
        'relaciones'=>$relaciones,
    ]) ?>

</div>
