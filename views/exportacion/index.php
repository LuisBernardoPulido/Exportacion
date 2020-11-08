<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExportacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exportacions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exportacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Exportacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'p11_id',
            'p11_guia',
            'p11_fecha',
            'r01_origen',
            'r01_destino',
            // 'c01_id',
            // 'p11_motivo',
            // 'p11_especie',
            // 'p11_aux',
            // 'p11_usuAlta',
            // 'p11_fecAlta',
            // 'p11_usuMod',
            // 'p11_fecMod',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
