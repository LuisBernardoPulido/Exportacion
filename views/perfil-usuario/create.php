<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PerfilUsuario */

$this->title = 'Crear usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="perfil-usuario-create">
    <?= $this->render('_form', [
        'model' => $model,
        'modelUser' => $modelUser,
        'msg'=>$msg,
    ]) ?>

</div>