<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Exportacion */

$this->title = 'Ingreso de ganado';
$this->params['breadcrumbs'][] = ['label' => 'Exportacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exportacion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
