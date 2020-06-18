<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Solicitudes */

$this->title = 'Generar solicitud';

?>
<div class="solicitudes-create">

    <?= $this->render('_form', [
        'model' => $model,
        'aretes' => $aretes,
    ]) ?>

</div>
