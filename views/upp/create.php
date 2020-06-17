<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Upp */

$this->title = 'Create Upp';
$this->params['breadcrumbs'][] = ['label' => 'Upps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
