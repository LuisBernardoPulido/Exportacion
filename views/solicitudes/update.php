<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitudes */

$this->title = 'Update Solicitudes: ' . $model->p09_id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->p09_id, 'url' => ['view', 'id' => $model->p09_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="solicitudes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
