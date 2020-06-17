<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ganaderos */

$this->title = 'Crear Productor';
$this->params['breadcrumbs'][] = ['label' => 'Productores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ganaderos-create">


    <?= $this->render('_form', [
        'model' => $model,
        'relaciones'=>$relaciones,
    ]) ?>

</div>
