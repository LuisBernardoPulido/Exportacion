<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Exportacion */

$this->title = 'Solicitud de exportación';
$this->params['breadcrumbs'][] = ['label' => 'Exportacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exportacion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
