<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PerfilUsuario */

$this->title = 'Editar usuario: '.' '.$model->a02_nombre;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->a02_nombre, 'url' => ['view', 'id' => $model->a02_id, "msg"=>""]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="perfil-usuario-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelUser' => $modelUser,
        'msg'=>$msg,
    ]) ?>

</div>
