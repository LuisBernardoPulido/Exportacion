<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\Estados;
use app\models\Municipios;
use yii\widgets\ActiveForm;
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_estados_productores_indice.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\GanaderosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Lista de Productores</div>
    <div class="panel-body">
        <div class="ganaderos-view" style="overflow-y: auto">

            <?php Pjax::begin(); ?>    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'c01_id',
                        'filter'=>  \kartik\widgets\Select2::widget([
                            'model'=> $searchModel,
                            'attribute'=>'c01_id',
                            'data' => \app\models\Ganaderos::getAllProductoresNombre(),
                            'options' => ['placeholder' => 'Seleccionar productor...'],
                            'pluginOptions' => [
                                'allowClear' => true,

                            ],
                        ]),
                        'value'=>function($model){
                            if($model->c01_tipo==0) {
                                return strtoupper($model->c01_nombre) . ' ' . strtoupper($model->c01_apaterno) . ' ' . mb_strtoupper($model->c01_amaterno);
                            }else{
                                return strtoupper($model->c01_razonsocial);
                            }
                        }
                    ],


                    'c01_curp',
                    'c01_rfc',
                    //'c01_telefono',
                    // 'c01_colonia',
                    // 'c01_calle',
                    // 'c01_cp',
                    // 'c01_localidad',
                    // 'c01_municipio',
                    [
                        'attribute'=>'c01_estado',
                        'filter'=>  \kartik\widgets\Select2::widget([
                            'model'=> $searchModel,
                            'attribute'=> 'c01_estado',
                            'data' => Estados::getAllEstados(),
                            'options' => ['placeholder' => 'Filtrar por estado...', 'id'=>'edo', 'onchange' => 'cargarMunicipiosProductor()'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]),
                        'contentOptions' => [
                            'width'=>'20%',
                        ],
                        'value'=>function($model){
                            return Estados::findOne($model->c01_estado)->c02_nom_ent;
                        }
                    ],
                    [
                        'attribute'=>'c01_municipio',
                        'filter'=>  \kartik\widgets\Select2::widget([
                            'model'=> $searchModel,
                            'attribute'=> 'c01_municipio',
                            'data' => \app\models\Municipios::getAllMuns(),
                            'options' => ['placeholder' => 'Filtrar por municipio...', 'id'=>'mpo'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]),
                        'contentOptions' => [
                            'width'=>'20%',
                        ],
                        'value'=>function($model){
                            return Municipios::findOne($model->c01_municipio)?Municipios::findOne($model->c01_municipio)->c03_nom_mun:'';
                        }
                    ],
                    // 'c01_correo',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end();
            ?>
        </div>
    </div>
</div>

