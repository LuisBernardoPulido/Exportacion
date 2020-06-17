<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Upp */

$this->title = 'Unidad de Producción';
$this->params['breadcrumbs'][] = ['label' => 'Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upp-create">

    <?= $this->render('_form', [
        'model' => $model,
        'relaciones'=>$relaciones,
    ]) ?>

</div>
