<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Estados;
use app\models\Municipios;
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_estados_unidades_indice.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UnidadesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$url = \yii\helpers\Url::to(['resenas/upplist']);
$this->title = 'Unidades de Producción Pecuaria';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Lista de Unidades de Producción Pecuaria</div>
    <div class="panel-body">
        <div class="upp-index" style="overflow-y: auto">

            <?php Pjax::begin(); ?>    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'r01_id',
                    [
                        'attribute'=>'r01_nombre',
                        'value'=>function($data){
                            return strtoupper($data->r01_nombre);
                        }
                    ],
                    //'r01_superficie',
                    [
                        'label' => 'Clave UPP',
                        'attribute' => 'r01_id',
                        'filter'=>  \kartik\widgets\Select2::widget([
                            'model'=> $searchModel,
                            'attribute' => 'r01_id',
                            'initValueText' => $searchModel->getAttribute('r01_id')?\app\models\Upp::findOne($searchModel->getAttribute('r01_id'))->r01_clave:'',
                            'options' => ['placeholder' => ' Seleccion UPP...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 6,
                                'language' => [
                                    'errorLoading' => new \yii\web\JsExpression("function () { return 'Waiting for results...'; }"),
                                ],
                                'ajax' => [
                                    'url' => $url,
                                    'dataType' => 'json',
                                    'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new \yii\web\JsExpression('function(upp) { return upp.text; }'),
                                'templateSelection' => new \yii\web\JsExpression('function (upp) { return upp.text; }'),
                            ],
                        ]),
                        'value'=>function($model){
                            $unidad =\app\models\Upp::findOne($model->r01_id);
                            return  $unidad->r01_clave;
                        },


                    ],
                    [
                        'attribute'=>'r01_estado',
                        'filter'=>  \kartik\widgets\Select2::widget([
                            'model'=> $searchModel,
                            'attribute'=> 'r01_estado',
                            'data' => Estados::getAllEstados(),
                            'options' => ['placeholder' => 'Filtrar por estado...', 'id'=>'edo', 'onchange' => 'cargarMunicipiosUnidad()'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]),
                        'contentOptions' => [
                            'width'=>'20%',
                        ],
                        'value'=>function($model){
                            return Estados::findOne($model->r01_estado)->c02_nom_ent;
                        }
                    ],
                    [
                        'attribute'=>'r01_municipio',
                        'filter'=>  \kartik\widgets\Select2::widget([
                            'model'=> $searchModel,
                            'attribute'=> 'r01_municipio',
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
                            return Municipios::findOne($model->r01_municipio)?Municipios::findOne($model->r01_municipio)->c03_nom_mun:'';
                        }
                    ],

                    //'r01_estado',
                    // 'r01_faretado',
                    // 'r01_tenencia',
                    // 'r01_mostrar',
                    // 'r01_usuAlta',
                    // 'r01_fecAlta',
                    // 'r01_usuMod',
                    // 'r01_fecMod',

                    [
                        'attribute' => '',
                        'format' => 'raw',
                        'label' => 'Acción',
                        'contentOptions'=>[
                            "align"=>'center',
                            // "width"=>"8%",
                        ],
                        'value' => function($model){

                            $ver='<a href="index.php?r=unidades/view&id='.$model->r01_id.'" title="Ver" aria-label="Ver" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>';
                            $editar='<a href="index.php?r=unidades/update&id='.$model->r01_id.'" title="Editar" aria-label="Editar" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';
                            $eliminar='<a href="'.\yii\helpers\Url::toRoute(['delete','id'=>$model->r01_id]).'" title="Eliminar" aria-label="Eliminar" data-confirm="¿Está seguro de eliminar este elemento?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>';


                            return '<div class="btn-group">'.$ver.' '.$editar.' '.$eliminar;
                        },
                        'contentOptions'=>[
                            "align"=>'center',
                        ],
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
