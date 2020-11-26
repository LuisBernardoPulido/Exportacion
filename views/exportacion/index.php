<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExportacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <div class="panel panel-primary" id="panel-primary-mpc">
        <div class="panel-heading" id="panel-heading-mpc">Lista de ingresos para exportación</div>
        <div class="panel-body">
<div class="exportacion-index">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'p11_guia',
            'p11_fecha',

            [
                'attribute'=>'r01_origen',
                'value'=>function($model){
                    $unidad = \app\models\Upp::findOne($model->r01_origen);
                    return $unidad->r01_clave.' - '.$unidad->r01_nombre;
                }
            ],
            [
                'attribute'=>'r01_destino',
                /*'contentOptions' => [
                    'width'=>'20%',
                ],*/
                'value'=>function($model){
                    $unidad = \app\models\Upp::findOne($model->r01_destino);
                    return $unidad->r01_clave.' - '.$unidad->r01_nombre;
                }
            ],
           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
        </div>
    </div>
</div>
</div>

