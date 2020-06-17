<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PerfilUsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perfil Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Perfil Usuario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'a02_id',
            'a01_id',
            'a02_nombre',
            'a02_apaterno',
            'a02_amaterno',
            // 'a02_email:email',
            // 'a02_telfono',
            // 'a02_direccion',
            // 'a02_activo',
            // 'a02_intentos',
            // 'a02_islab',
            // 'a02_usuAlta',
            // 'a02_fecAlta',
            // 'a02_usuMod',
            // 'a02_fecMod',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
