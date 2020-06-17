<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\View;
use app\models\Utileria;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;

$this->registerJsFile(Yii::$app->request->baseUrl . '/bootstrap-select-1.12.2/bootstrap-select.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->request->baseUrl.'/bootstrap-select-1.12.2/bootstrap-select.css');
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_reportes.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MotivosPruebaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$url = \yii\helpers\Url::to(['resenas/upplist']);
$url_medicos = \yii\helpers\Url::to(['resenas/medicoslista']);
$this->title = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;
if($tipo!=null){
    if($tipo==2 || $tipo==5){
        $reporte_show=true;
    }else{
        $reporte_show = false;
    }

}else{
    $reporte_show=true;
}
?>
<br>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Selecciona el reporte</div>
    <div class="panel-body">
        <div class="motivos-prueba-index">

            <?php
            if($reporte_show){
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <label for="todos">Reporte</label><br>
                        <select class="selectpicker" id="todos" title="Selecciona una opción..." onchange="reportes()" required>
                            <!--<option value="0">Selecciona una opción</option>-->
                            <option value="1">Unidades de producción</option>
                            <option value="2">Aretes</option>
                            <option value="3">Tasa de respuesta</option>
                            <option value="4">Dictamenes</option>
                            <option value="5">Control de folios</option>
                            <option value="6">Laboratorio</option>
                            <!--<option value="7">Reporte SINIIGA</option>-->
                            <!--<option value="8">Engorda</option>-->
                            <option value="9">Certificado de origen*</option>
                            <option value="10">Médicos*</option>
                            <option value="11">Trazabilidad</option>
                            <option value="12">Hato*</option>
                            <option value="13">Cuarentena*</option>
                        </select>

                    </div>
                </div>

                <?php

            }
            ?>

            <br>
            <br>
            <div class="col-md-12">
                <div class="panel panel-info comp" id="panel-info-mpc" style="display: none">
                    <div class="panel-heading" id="panel-info-header">Filtros del Reporte</div>
                    <div class="panel-body">

                        <div class="row" id="cmedicos" style="display:none;">
                            <div class="col-md-4">
                                <label for="medicos">Tipo de Reporte</label><br>
                                <select class="selectpicker form-control" id="medicos" onchange="medicos_check()" title="Selecciona una opción...">
                                    <option value="0">Tasa de respuesta cervical comparativa</option>
                                    <option value="1">Tasa de respuesta pliegue caudal</option>
                                    <!--<option value="1">Fijaciones</option>
                                    <option value="2">Vacunas</option>-->
                                </select>

                            </div>
                            <div class="col-md-5">
                                <br>
                                <div class="panel panel-info comp" id="contenido_pcc" style="display: none">
                                    <div class="panel-heading" id="panel-info-header">Periodo</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="medicos">Desde</label><br>

                                                <?=
                                                DatePicker::widget([
                                                    'name' => 'desde_pcc',
                                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                    'value' => date('Y-m-d'),
                                                    'pluginOptions' => [
                                                        'autoclose'=>true,
                                                        'format' => 'yyyy-mm-dd',

                                                    ],
                                                    'options' => [
                                                        'id' => 'desde_pccs'
                                                    ]
                                                ]);
                                                ?>


                                            </div>
                                            <div class="col-md-6">
                                                <label for="medicos">Hasta</label><br>

                                                <?=
                                                DatePicker::widget([
                                                    'name' => 'hasta_pcc',
                                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                    'value' => date('Y-m-d'),
                                                    'pluginOptions' => [
                                                        'autoclose'=>true,
                                                        'format' => 'yyyy-mm-dd'
                                                    ],
                                                    'options' => [
                                                        'id' => 'hasta_pccs'
                                                    ]
                                                ]);
                                                ?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!--UPP-->
                        <div class="row" id="cupp"  style="display:none;">
                            <div class="col-md-3">
                                <label for="upp">Tipo de Reporte</label><br>
                                <select class="selectpicker form-control" id="upp" title="Selecciona una opción..." onchange="upps()">
                                    <option value="0">Concentrado</option>
                                    <option value="1">Consulta por unidad*</option>
                                    <option value="2">Consulta por municipio*</option>
                                    <option value="2">Consulta por productor*</option>
                                </select>

                            </div>
                            <div class="col-md-3" style="display: none;" id="show_upp_upp">
                                <label for="aretes">Clave de unidad de producción</label><br>

                                <?= \kartik\widgets\Select2::widget([
                                    'name'=>'unidades_upp',
                                    'hideSearch'=>true,
                                    'options' => ['placeholder' => 'Seleccionar unidad de producción...'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'minimumInputLength' => 11,
                                        'language' => [
                                            'errorLoading' => new \yii\web\JsExpression("function () { return 'Esperando resultados...'; }"),
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
                                ]) ?>

                            </div>

                        </div>
                        <!--Fin UPP-->


                        <!--Aretes-->
                        <div class="row" id="caretes" style="display:none;">
                            <div class="col-md-3">

                                <label for="aretes">Tipo de Reporte</label><br>
                                <select class="selectpicker form-control" id="aretes" title="Selecciona una opción..." onchange="aretes()">
                                    <option value="0">Concentrado</option>
                                    <option value="1">Hato por unidad</option>
                                    <!--<option value="2">Trazabilidad</option>-->
                                </select>
                            </div>
                            <div class="col-md-3" style="display: none;" id="show_upp">
                                <label for="aretes">UPP</label><br>

                                <?= \kartik\widgets\Select2::widget([
                                    'name'=>'unidades',
                                    'hideSearch'=>true,
                                    'options' => ['placeholder' => 'Seleccionar unidad de producción...', 'id'=>'upp_per_aretes'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'minimumInputLength' => 6,
                                        'language' => [
                                            'errorLoading' => new \yii\web\JsExpression("function () { return 'Esperando resultados...'; }"),
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
                                ]) ?>

                            </div>
                            <div class="col-md-5" style="display: none;" id="arete_trazabilidad">
                                <div class="col-md-6">
                                    <label for="aretes">Arete</label><br>
                                    <?= Html::input("number", "aretenumber", null, ["class" => "form-control", 'min'=>'0','id'=>'arete_traza', 'style'=>'text-align:right;', 'required'=>true])?>
                                </div>
                                <div class="col-md-6">
                                    <label for="aretes">Especie</label><br>
                                    <select class="selectpicker form-control" id="especie_tra" title="Selecciona una especie..."">
                                    <option value="1">Bovino</option>
                                    <option value="2">Caprino</option>
                                    <option value="3">Ovino</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="row" id="cdictamenes" style="display:none;">
                            <div class="col-md-3">
                                <label for="dictamenes">Tipo de Reporte</label><br>
                                <select class="selectpicker form-control" id="dictamenes" title="Selecciona una opción..." onchange="dictamenes()">
                                    <option value="0">Consultar por folio</option>
                                    <option value="1">Consultar por UPP</option>
                                </select>

                            </div>
                            <div class="col-md-3" style="display: none;" id="show_upp_dictamen">
                                <label for="aretes">UPP</label><br>

                                <?= \kartik\widgets\Select2::widget([
                                    'name'=>'unidades_dictamen',
                                    'hideSearch'=>true,
                                    'options' => ['placeholder' => 'Seleccionar unidad de producción...', 'id'=>'unidadesfolios'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'minimumInputLength' => 6,
                                        'language' => [
                                            'errorLoading' => new \yii\web\JsExpression("function () { return 'Esperando resultados...'; }"),
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
                                ]) ?>

                            </div>
                            <div class="col-md-3" id="folio_div" style="display: none;" id="folio_dictamen">
                                <label for="aretes">Folio</label><br>

                                <?= Html::input("number", "folios", null, ["class" => "form-control", 'min'=>'0','id'=>'folioid', 'style'=>'text-align:right;', 'required'=>true])?>


                            </div>
                        </div>

                        <!--Otros-->
                        <div id="cotros" style="display:none;">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="medicos">Tipo de Reporte</label><br>
                                    <select class="selectpicker form-control" id="otros" onchange="otros_check()" title="Selecciona una opción...">
                                        <option value="0">Folios tuberculosis</option>
                                        <option value="1">Folios brucelosis</option>
                                        <option value="2">Folios vacunación</option>
                                        <option value="3">Dictamenes vencidos por Médico</option>
                                        <!--<option value="1">Entrega de Documentación BR</option>-->
                                    </select>

                                </div>
                                <div class="col-md-4" id="filtro_cf" style="display: none">
                                    <label for="filtros">Filtros</label><br>
                                    <select class="selectpicker form-control" id="otros_filtro" onchange="otros_filtro_check()" title="Selecciona un filtro..."">
                                    <option value="0">Con folio</option>
                                    <option value="1">Entregados</option>
                                    <option value="2">Pendientes por Entregar</option>
                                    <option value="3">Sin Folio</option>
                                    <option value="4">Dictamenes con fecha de entrega vencida</option>
                                    </select>
                                </div>
                                <div class="col-md-5" style="display: none;" id="filtro_cf_medicos">
                                    <label for="medicos">Médicos</label><br>

                                    <?= \kartik\widgets\Select2::widget([
                                        'name'=>'lista_medicos',
                                        'hideSearch'=>true,
                                        'options' => ['placeholder' => 'Buscar Médico...', 'id'=>'lista_medicos'],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'minimumInputLength' => 3,
                                            'language' => [
                                                'errorLoading' => new \yii\web\JsExpression("function () { return 'Esperando resultados...'; }"),
                                            ],
                                            'ajax' => [
                                                'url' => $url_medicos,
                                                'dataType' => 'json',
                                                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                                            ],
                                            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                                            'templateResult' => new \yii\web\JsExpression('function(upp) { return upp.text; }'),
                                            'templateSelection' => new \yii\web\JsExpression('function (upp) { return upp.text; }'),
                                        ],
                                    ]) ?>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-info comp" id="contenido_tasas" style="display: none">
                                        <div class="panel-heading" id="panel-info-header">Rango de fechas</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="otros">Desde</label><br>

                                                    <?=
                                                    DatePicker::widget([
                                                        'name' => 'desde_tasa',
                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                        'value' => date('Y-m-d'),
                                                        'pluginOptions' => [
                                                            'autoclose'=>true,
                                                            'format' => 'yyyy-mm-dd',

                                                        ],
                                                        'options' => [
                                                            'id' => 'id_desde_tasa'
                                                        ]
                                                    ]);
                                                    ?>


                                                </div>
                                                <div class="col-md-6">
                                                    <label for="medicos">Hasta</label><br>

                                                    <?=
                                                    DatePicker::widget([
                                                        'name' => 'hasta_tasa',
                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                        'value' => date('Y-m-d'),
                                                        'pluginOptions' => [
                                                            'autoclose'=>true,
                                                            'format' => 'yyyy-mm-dd'
                                                        ],
                                                        'options' => [
                                                            'id' => 'id_hasta_tasa'
                                                        ]
                                                    ]);
                                                    ?>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!--Laboratotio-->
                        <div class="row" id="clab" style="display:none;">
                            <div class="col-md-3">
                                <label for="medicos">Tipo de Reporte</label><br>
                                <select class="selectpicker form-control" id="lab" onchange="lab_check()" title="Selecciona una opción...">
                                    <option value="0">Informe</option>
                                    <option value="1">Reporte SIVE</option>
                                    <!--<option value="1">Entrega de Documentación BR</option>-->
                                </select>

                            </div>
                            <div class="col-md-5">
                                <br>
                                <div class="panel panel-info comp" id="contenido_lab" style="display: none">
                                    <div class="panel-heading" id="panel-info-header">Rango de fechas</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="lab">Desde</label><br>

                                                <?=
                                                DatePicker::widget([
                                                    'name' => 'desde_lab',
                                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                    'value' => date('Y-m-d'),
                                                    'pluginOptions' => [
                                                        'autoclose'=>true,
                                                        'format' => 'yyyy-mm-dd',

                                                    ],
                                                    'options' => [
                                                        'id' => 'id_desde_lab'
                                                    ]
                                                ]);
                                                ?>


                                            </div>
                                            <div class="col-md-6">
                                                <label for="lab">Hasta</label><br>

                                                <?=
                                                DatePicker::widget([
                                                    'name' => 'hasta_lab',
                                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                    'value' => date('Y-m-d'),
                                                    'pluginOptions' => [
                                                        'autoclose'=>true,
                                                        'format' => 'yyyy-mm-dd'
                                                    ],
                                                    'options' => [
                                                        'id' => 'id_hasta_lab'
                                                    ]
                                                ]);
                                                ?>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Fin Laboratotio-->

                        <!--Engorda-->
                        <div id="cengorda" style="display:none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="medicos">Tipo de Reporte</label><br>
                                    <select class="selectpicker form-control" id="cengorda_check" onchange="engorda_check()" title="Selecciona una opción...">
                                        <option value="0">Entradas y Salidas de Ganado</option>
                                    </select>

                                </div>
                                <div class="col-md-6" id="filtro_cengorda" style="display: none">
                                    <label for="filtros_eng">Filtros</label><br>
                                    <select class="selectpicker form-control" id="cengorda_filtro" onchange="engorda_filtro()" title="Selecciona un filtro..."">
                                    <option value="0">Ver Todo</option>
                                    <option value="1">Rango de Fechas por Entrada</option>
                                    <option value="2">Rango de Fechas por Salida</option>
                                    <option value="3">Por Corral</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-info comp" id="contenido_engorda" style="display: none">
                                        <div class="panel-heading" id="panel-info-header">Periodo</div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="desde_eng">Desde</label><br>

                                                    <?=
                                                    DatePicker::widget([
                                                        'name' => 'desde_eng',
                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                        'value' => date('Y-m-d'),
                                                        'pluginOptions' => [
                                                            'autoclose'=>true,
                                                            'format' => 'yyyy-mm-dd',

                                                        ],
                                                        'options' => [
                                                            'id' => 'id_desde_eng'
                                                        ]
                                                    ]);
                                                    ?>


                                                </div>
                                                <div class="col-md-6">
                                                    <label for="hasta_eng">Hasta</label><br>

                                                    <?=
                                                    DatePicker::widget([
                                                        'name' => 'hasta_eng',
                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                        'value' => date('Y-m-d'),
                                                        'pluginOptions' => [
                                                            'autoclose'=>true,
                                                            'format' => 'yyyy-mm-dd'
                                                        ],
                                                        'options' => [
                                                            'id' => 'id_hasta_eng'
                                                        ]
                                                    ]);
                                                    ?>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                </div>

                                <div class="col-md-6">
                                    <div style="display: none;" id="corral_engorda">
                                        <label for="corral">Corral</label><br>
                                        <?= Html::input("number", "corralnumber", null, ["class" => "form-control", 'min'=>'0','id'=>'corral_eng', 'style'=>'text-align:right;', 'required'=>true])?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--Fin Engorda-->

                        <!--Inicio médicos-->
                        <div class="row" id="cmvz"  style="display:none;">
                            <div class="col-md-3">
                                <label for="mvz">Tipo de Reporte</label><br>
                                <select class="selectpicker form-control" id="mvz" title="Selecciona una opción...">
                                    <option value="0">Concentrado*</option>
                                    <option value="1">Por nombre*</option>
                                </select>

                            </div>

                        </div>
                        <!--Fin médicos-->

                        <!--Inicio trazabilidad-->
                        <div class="row" style="display: none;" id="ctrazabilidad">
                            <div class="col-md-3">
                                <label for="aretes">Aretessss</label><br>
                                <?= Html::input("number", "aretenumber", null, ["class" => "form-control", 'min'=>'0','id'=>'arete_trazab', 'style'=>'text-align:right;', 'required'=>true])?>
                            </div>
                            <div class="col-md-3">
                                <label for="aretes">Especiess</label><br>
                                <select class="selectpicker form-control" id="especie_trazabilidad" title="Selecciona una especie..."">
                                <option value="1">Bovino</option>
                                <option value="2">Caprino</option>
                                <option value="3">Ovino</option>
                                </select>
                            </div>
                        </div>
                        <!--Fin trazabilidad-->


                    </div>
                </div>
            </div>

            <?php
            if($tipo==1) {
                ?>
                <div class="panel panel-info comp" id="panel-info-mpc" style="display: block">
                    <div class="panel-heading" id="panel-info-header">Datos de Unidad</div>
                    <div class="panel-body">
                        <?= \yii\widgets\DetailView::widget([
                            'model' => $upp,
                            'attributes' => [



                                'r01_clave',
                                'r01_nombre',
                                [
                                    'label'=>'Propietario',
                                    'value'=>function($data){
                                        $return='';
                                        $relaciones = \app\models\PropietarioUnidad::find()->where('r01_id=:unidad', [':unidad'=>$data->r01_id])->all();
                                        foreach ($relaciones as $r){
                                            $gan =\app\models\Ganaderos::findOne($r->c01_id);
                                            if($gan->c01_tipo!=1){
                                                $return.= $gan->c01_nombre.' '.$gan->c01_apaterno.' '.$gan->c01_amaterno.'<br>';
                                            }else{
                                                $return.= $gan->c01_razonsocial.'<br>';
                                            }
                                        }
                                        return $return;
                                    },
                                    'format' => 'raw',
                                ],



                            ],
                        ]) ?>

                    </div>
                </div>
                <?=
                \yii\grid\GridView::widget([
                    'dataProvider' => $aretes,
                    'columns' => [
                        [
                            'label' => 'Arete',
                            'value' =>'r02_numero',
                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Edad',
                            'value' => 'r02_edad',
                            'format' => 'raw'
                        ],
                        [
                            'label'=>'Fecha de Nacimiento',
                            'value'=>'r02_fnacimiento',
                            'format'=>'raw',
                        ],

                        [
                            'label' => 'Raza',
                            'value' => function($data){
                                $value = \app\models\Razas::findOne(\app\models\Aretes::findOne($data)->r02_raza)->c06_clave;
                                if(\app\models\Aretes::findOne($data)->r02_raza2){
                                    $value.= ' / '.\app\models\Razas::findOne(\app\models\Aretes::findOne($data)->r02_raza2)->c06_clave;
                                }
                                return $value;

                            },
                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Sexo',
                            'value' => function($data){
                                if(\app\models\Aretes::findOne($data->r02_id)->r02_sexo=='0'){
                                    return "Macho";
                                }else{
                                    return "Hembra";
                                }
                            },

                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Especie',
                            'value' => function($data){
                                return \app\models\Especies::findOne($data->r02_especie)->c11_descrip;
                            },

                            'format' => 'raw'
                        ],


                    ],
                ]);
                ?>
                <?php
            }
            ?>

            <!--Trazabilidad-->
            <?php
            if($tipo==3) {
                $arete_actual = \app\models\Aretes::getOnlyArete($arete);
                ?>
                <h3>Estado actual arete <b><?=$arete?></b></h3>
                <br>
                <?=
                \yii\grid\GridView::widget([
                    'dataProvider' => $arete_actual,
                    'summary' => '',
                    'columns' => [
                        [
                            'label' => 'Upp',
                            'value' =>function($data){
                                return \app\models\Upp::findOne($data->r01_id)->r01_clave;
                            },
                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Edad',
                            'value' => 'r02_edad',
                            'format' => 'raw'
                        ],

                        [
                            'label' => 'Raza',
                            'value' => function($data){
                                $value = \app\models\Razas::findOne(\app\models\Aretes::findOne($data)->r02_raza)->c06_clave;
                                if(\app\models\Aretes::findOne($data)->r02_raza2){
                                    $value.= ' / '.\app\models\Razas::findOne(\app\models\Aretes::findOne($data)->r02_raza2)->c06_clave;
                                }
                                return $value;

                            },
                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Sexo',
                            'value' => function($data){
                                if(\app\models\Aretes::findOne($data->r02_id)->r02_sexo=='0'){
                                    return "Macho";
                                }else{
                                    return "Hembra";
                                }
                            },

                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Especie',
                            'value' => function($data){
                                return \app\models\Especies::findOne($data->r02_especie)->c11_descrip;
                            },

                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Realizado por',
                            'value' => function($data){
                                return \app\models\User::findIdentity($data->r02_usuAlta)->username;
                            },

                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Fecha de movimiento',
                            'value' => 'r02_fecAlta',

                            'format' => 'raw'
                        ],


                    ],
                ]);
                ?>
                <br>
                <h3>Movimientos de arete</h3>
                <br>
                <?=
                \yii\grid\GridView::widget([
                    'dataProvider' => \app\models\Remo::getMovimientosPorArete($arete),
                    'summary' => '',
                    'columns' => [
                        [
                            'label' => 'Upp',
                            'value' =>function($data){
                                return \app\models\Upp::findOne($data->r01_origen)->r01_clave;
                            },
                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Edad',
                            'value' =>  function($data){
                                return $data->r02_edad?$data->r02_edad:'';
                            },
                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Raza',
                            'value' => function($data){
                                if($data->r02_raza){
                                    $value = \app\models\Razas::findOne($data->r02_raza)->c06_clave;
                                }else{
                                    $value = "";
                                }

                                if($data->r02_raza2){
                                    $value.= ' / '.\app\models\Razas::findOne($data->r02_raza2)->c06_clave;
                                }
                                return $value;

                            },
                            'format' => 'raw'
                        ],

                        [
                            'label' => 'Sexo',
                            'value' => function($data){
                                if($data->r02_sexo){
                                    if($data->r02_sexo=='0'){
                                        return "Macho";
                                    }else{
                                        return "Hembra";
                                    }
                                }else{
                                    return "";
                                }

                            },

                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Especie',
                            'value' => function($data){
                                return $data->r02_especie?\app\models\Especies::findOne($data->r02_especie)->c11_descrip:'';
                            },

                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Realizado por',
                            'value' => function($data){
                                return \app\models\User::findIdentity($data->p04_usuAlta)->username;
                            },

                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Fecha de movimiento',
                            'value' => 'p04_fecAlta',

                            'format' => 'raw'
                        ],


                    ],
                ]);

                ?>
                <!--Arete actual-->


                <?php
            }
            ?>

            <?php
            if($tipo!=null){
                if($tipo!=2 && $tipo!=5) {

                    ?><br>
                    <?php
                    if ($upp) {
                        $id = $upp->r01_id;
                    } else {
                        $id = 0;
                    }
                    ?>
                    <div class="form-group">
                        <?= Html::button('Descargar', ['class' => 'btn btn-primary button_crear', 'onclick' => 'imprimir_button(' . $tipo . ', ' . $id . ')', 'title' => "Generar reporte en Excel"]) ?>
                        &nbsp;&nbsp;&nbsp;<a href='index.php?r=site/reportes'
                                             role="button"><?= Html::button('Regresar', ['class' => 'btn btn-info button_crear', 'title' => "Regresar", 'href' => 'reportes']) ?></a>

                    </div>
                    <?php
                }else{
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('Generar', ['class' => 'btn btn-primary button_crear', 'onclick'=>'check_button()', 'title'=>"Generar reporte en Excel"]) ?>

                    </div>
                    <?php


                }
            }else{
                ?>
                <div class="form-group">
                    <?= Html::submitButton('Generar', ['class' => 'btn btn-primary button_crear', 'onclick'=>'check_button()', 'title'=>"Generar reporte en Excel"]) ?>

                </div>
                <?php

            }
            ?>

        </div>
    </div>
</div>


<?php
if($tipo==1 && $imprimir==1) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';


    $aretes = \app\models\Aretes::find()->where('r01_id=:id', [':id'=>$upp->r01_id])->all();

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/aretes.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');


    $estilo = $objPHPExcel->getActiveSheet()->getStyle('B4');
    $indice = 4;

    foreach ($aretes as $a) {

        $objPHPExcel->getActiveSheet()->setCellValue(\app\models\Utileria::getCelda(2, $indice), \app\models\Upp::findOne($a->r01_id)->r01_clave);
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(2, $indice));

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $a->r02_numero);
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(3, $indice));

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $a->r02_edad);
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(4, $indice));
        if(\app\models\Razas::findOne($a->r02_raza)->c06_clave){
            $raza1 = \app\models\Razas::findOne($a->r02_raza)->c06_clave;
        }else{
            $raza1="";
        }
        if(\app\models\Razas::findOne($a->r02_raza2)){
            $raza2 = "/".\app\models\Razas::findOne($a->r02_raza2)->c06_clave;
        }else{
            $raza2="";
        }


        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $raza1.$raza2);
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(5, $indice));

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $a->r02_sexo==1?'M':'H');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(6, $indice));

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), \app\models\Especies::findOne($a->r02_especie)->c11_descrip2);
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(7, $indice));




        $indice++;
    }


    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "Hato_" . date('d-m-Y');
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    /**/
    $script = "
        var a = document.createElement('a');
		a.download = '" . $nombre . "';
		a.href = 'files/excel/" . $nombre . ".xlsx';
		a.click();

		";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');

}

if($tipo==2) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    //$arete_traza = 3529281;
    $num_arete = \app\models\Aretes::find()->where('r02_numero='.$arete)->andWhere('r02_especie='.$especie)->one();
    $query = null;
    if($num_arete){
        $query = \app\models\SeleccionPreviaAretes::findBySql(
            "SELECT
*
FROM p02_seleccion_previa p02
INNER JOIN r05_seleccion_previa_aretes r05 ON p02.p02_id=r05.p02_id
WHERE r05.r02_id=$num_arete->r02_id AND (r05.r05_tb=1 || r05.r05_br=1 ||  r05.r05_vc=1)")->all();

        $objPHPExcel = new PHPExcel();
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/trazabilidad.xlsx');
        $objPHPExcel->setActiveSheetIndex(0);

        setlocale(LC_CTYPE, 'de_DE.UTF8');


        $estilo = $objPHPExcel->getActiveSheet()->getStyle('B4');
        $indice = 4;
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, 2), "ARETE: " . $arete);
        foreach ($query as $a) {
            $info_are = Yii::$app->db->createCommand("
SELECT
DATE_FORMAT(p02_fecAlta, \"%d/%m/%Y\") AS fecha,
(SELECT CONCAT(c05_nombre, ' ', IFNULL(c05_apaterno,''), ' ', IFNULL(c05_amaterno,'') ) FROM c05_mvz WHERE c05_id=p02.c05_id) AS medico,
(SELECT CONCAT(r01_clave,' - ', r01_nombre) FROM r01_upp WHERE r01_id=p02.c01_id) AS upp,
r05.r02_edad AS edad,
CONCAT((SELECT c06_clave FROM c06_raza WHERE c06_id=r05.r02_raza), IFNULL(CONCAT('/' ,(SELECT c06_clave FROM c06_raza WHERE c06_id=r05.r02_raza2)), '')) AS raza,
IF(r05.r02_sexo=1, 'HEMBRA', 'MACHO') AS sexo,
IF(r03_dictamen_tb,IFNULL((SELECT p03_folio FROM p03_tb WHERE p03_id=p02.r03_dictamen_tb),'SIN FOLIO') ,'') AS dictamen_tb,
(SELECT DATE_FORMAT(p03_finyeccion, \"%d/%m/%Y\") FROM p03_tb WHERE p03_id=p02.r03_dictamen_tb) AS fecha_tb,
IF(r03_dictamen_br,IFNULL((SELECT p03_folio FROM p03_br WHERE p03_id=p02.r03_dictamen_br),'SIN FOLIO') ,'') AS dictamen_br,
(SELECT DATE_FORMAT(p03_fmuestreo, \"%d/%m/%Y\") FROM p03_br WHERE p03_id=r03_dictamen_br) AS fecha_br,
IF(r03_dictamen_vc,IFNULL((SELECT p03_folio FROM p03_vc WHERE p03_id=p02.r03_dictamen_vc),'SIN FOLIO') ,'') AS dictamen_vc,
(SELECT DATE_FORMAT(p03_fexpedicion, \"%d/%m/%Y\") FROM p03_vc WHERE p03_id=r03_dictamen_vc) AS fecha_vc
FROM p02_seleccion_previa p02
INNER JOIN r05_seleccion_previa_aretes r05 ON p02.p02_id=r05.p02_id
WHERE r05.r05_id=$a->r05_id
",[])->queryAll();
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $info_are[0]['fecha']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $info_are[0]['medico']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $info_are[0]['upp']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $info_are[0]['edad']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $info_are[0]['raza']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $info_are[0]['sexo']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $info_are[0]['dictamen_tb']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $info_are[0]['fecha_tb']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $info_are[0]['dictamen_br']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $info_are[0]['fecha_br']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $info_are[0]['dictamen_vc']);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $info_are[0]['fecha_vc']);

            $indice++;
        }


        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $nombre = "Trazabilidad_" . $arete . "_" .date('d-m-Y');
        $objWriter->save("files/excel/" . $nombre . ".xlsx");
        $script = "
        var a = document.createElement('a');
		a.download = '" . $nombre . "';
		a.href = 'files/excel/" . $nombre . ".xlsx';
		a.click();

		";
        $this->registerJs($script, View::POS_LOAD, 'descargarReporte');

    }

}

if($tipo==5) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $desde_pcc = Yii::$app->request->get("desde", Utileria::getFechaActualOnly());
    $hasta_pcc = Yii::$app->request->get("hasta", Utileria::getFechaActualOnly());

    $medicos = \app\models\Medicos::findBySql("select * from c05_mvz where c05_id in (select c05_id from p03_tb tb where (p03_tipoPrueba = 5 or p03_tipoPrueba=7) and (p03_flectura>= '".$desde_pcc."' && p03_flectura<= '".$hasta_pcc."' ) and ((select r01_zona from r01_upp where r01_id=tb.r01_id)=1))")->all();


    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/pcc.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');

    $objPHPExcel->getActiveSheet()->setCellValue(\app\models\Utileria::getCelda(4, 13), 'ZACATECAS'); //ESTADO
    $objPHPExcel->getActiveSheet()->setCellValue(\app\models\Utileria::getCelda(4, 14), $desde_pcc.' - '.$hasta_pcc); //Periodo
    $objPHPExcel->getActiveSheet()->setCellValue(\app\models\Utileria::getCelda(4, 15), Utileria::getFechaActualOnly()); //FEcha de elaboración

    $indice = 24;
    $contador_indice = 1;
    foreach ($medicos as $a) {
        $estilo = $objPHPExcel->getActiveSheet()->getStyle('B24');
        $objPHPExcel->getActiveSheet()->setCellValue(\app\models\Utileria::getCelda(2, $indice), $contador_indice); //Número
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(2, $indice));

        $estilo = $objPHPExcel->getActiveSheet()->getStyle('C24');
        $objPHPExcel->getActiveSheet()->setCellValue(\app\models\Utileria::getCelda(3, $indice), $a->c05_nombre." ".$a->c05_apaterno." ".$a->c05_amaterno); //Nombre médico
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(3, $indice));

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $a->c05_clave); //Clave
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(4, $indice));


        $dicts= \app\models\Tuberculosis::findBySql("select * from p03_tb tb where c05_id=$a->c05_id and (p03_tipoPrueba=5 or p03_tipoPrueba=7) and (p03_flectura>= '".$desde_pcc."' && p03_flectura<= '".$hasta_pcc."' ) and ((select r01_zona from r01_upp where r01_id=tb.r01_id)=1)")->all();
        $contador=0;
        foreach ($dicts as $d){
            $aux = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->count();
            $contador+=$aux;
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), strval($contador)); //Cantidad
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(5, $indice));
        $contador2=0;
        foreach ($dicts as $d){
            $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
            $contador2+=$aux2;
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $contador2); //positivas
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(7, $indice));
        $contador2=0;
        foreach ($dicts as $d){
            $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>4])->count();
            $contador2+=$aux2;
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $contador2); //negativas
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(8, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>5])->count();
            $contador2+=$aux2;
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $contador2); //sospechosos
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(9, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            if($d->p03_motivoPrueba == 24){
                $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
                $contador2+=$aux2;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $contador2); //por barrido
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(11, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            if($d->p03_motivoPrueba == 18 || $d->p03_motivoPrueba == 7 || $d->p03_motivoPrueba == 6){
                $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
                $contador2+=$aux2;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $contador2); //por seguimiento epidemiol
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(12, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            if($d->p03_motivoPrueba == 15){
                $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
                $contador2+=$aux2;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $contador2); //ppor exportacion
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(13, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            if($d->p03_motivoPrueba == 14 || $d->p03_motivoPrueba == 28 || $d->p03_motivoPrueba == 26){
                $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
                $contador2+=$aux2;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), $contador2); //por hato libre
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(14, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            if($d->p03_motivoPrueba == 17){
                $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
                $contador2+=$aux2;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $contador2); //ppor movilización
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(15, $indice));




        $contador_indice++;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($indice+1, 1);
        $indice++;

    }

    //Total Región A
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice+1), '=SUM(G24:G'.($indice-1).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice+1), '=SUM(H24:H'.($indice-1).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice+1), '=SUM(I24:I'.($indice-1).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice+1), '=SUM(K24:K'.($indice-1).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice+1), '=SUM(L24:L'.($indice-1).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice+1), '=SUM(M24:M'.($indice-1).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice+1), '=SUM(N24:N'.($indice-1).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice+1), '=SUM(O24:O'.($indice-1).')');



    //ZONA B
    $medicos = \app\models\Medicos::findBySql("select * from c05_mvz where c05_id in (select c05_id from p03_tb tb where (p03_tipoPrueba = 5 or p03_tipoPrueba=7) and (p03_flectura>= '".$desde_pcc."' && p03_flectura<= '".$hasta_pcc."' ) and ((select r01_zona from r01_upp where r01_id=tb.r01_id)!=1))")->all();


    $guardar_indice = $indice;


    $indice = $indice+2;
    $contador_indice = 1;
    foreach ($medicos as $a) {
        $estilo = $objPHPExcel->getActiveSheet()->getStyle('B24');
        $objPHPExcel->getActiveSheet()->setCellValue(\app\models\Utileria::getCelda(2, $indice), $contador_indice); //Número
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(2, $indice));

        $estilo = $objPHPExcel->getActiveSheet()->getStyle('C24');
        $objPHPExcel->getActiveSheet()->setCellValue(\app\models\Utileria::getCelda(3, $indice), $a->c05_nombre." ".$a->c05_apaterno." ".$a->c05_amaterno); //Nombre médico
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(3, $indice));

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $a->c05_clave); //Clave
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(4, $indice));


        $dicts= \app\models\Tuberculosis::findBySql("select * from p03_tb tb where c05_id=$a->c05_id and (p03_tipoPrueba=5 or p03_tipoPrueba=7) and (p03_flectura>= '".$desde_pcc."' && p03_flectura<= '".$hasta_pcc."' ) and ((select r01_zona from r01_upp where r01_id=tb.r01_id)!=1)")->all();
        $contador=0;
        foreach ($dicts as $d){
            $aux = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->count();
            $contador+=$aux;
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), strval($contador)); //Cantidad
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(5, $indice));
        $contador2=0;
        foreach ($dicts as $d){
            $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
            $contador2+=$aux2;
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $contador2); //positivas
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(7, $indice));
        $contador2=0;
        foreach ($dicts as $d){
            $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>4])->count();
            $contador2+=$aux2;
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $contador2); //negativas
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(8, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>5])->count();
            $contador2+=$aux2;
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $contador2); //sospechosos
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(9, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            if($d->p03_motivoPrueba == 8){
                $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
                $contador2+=$aux2;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $contador2); //por barrido
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(11, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            if($d->p03_motivoPrueba == 6 || $d->p03_motivoPrueba == 7){
                $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
                $contador2+=$aux2;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $contador2); //por seguimiento epidemiol
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(12, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            if($d->p03_motivoPrueba == 15){
                $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
                $contador2+=$aux2;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $contador2); //ppor exportacion
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(13, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            if($d->p03_motivoPrueba == 14){
                $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
                $contador2+=$aux2;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), $contador2); //por hato libre
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(14, $indice));

        $contador2=0;
        foreach ($dicts as $d){
            if($d->p03_motivoPrueba == 17){
                $aux2 = \app\models\TuberculosisAretes::find()->where('p03_tb=:tb', [':tb'=>$d->p03_id])->andWhere('r06_diagnostico=:res', [':res'=>6])->count();
                $contador2+=$aux2;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $contador2); //ppor movilización
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(15, $indice));





        $contador_indice++;
        $objPHPExcel->getActiveSheet()->insertNewRowBefore($indice+1, 1);
        $indice++;

    }

    if($medicos){
        //Total Región B
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice+1), '=SUM(G'.($guardar_indice+2).':G'.($indice-1).')');
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice+1), '=SUM(H'.($guardar_indice+2).':H'.($indice-1).')');
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice+1), '=SUM(I'.($guardar_indice+2).':I'.($indice-1).')');

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice+1), '=SUM(K'.($guardar_indice+2).':K'.($indice-1).')');
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice+1), '=SUM(L'.($guardar_indice+2).':L'.($indice-1).')');
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice+1), '=SUM(M'.($guardar_indice+2).':M'.($indice-1).')');
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice+1), '=SUM(N'.($guardar_indice+2).':N'.($indice-1).')');
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice+1), '=SUM(O'.($guardar_indice+2).':O'.($indice-1).')');

    }


    //DATOS DE USUARIO
    $perfil = \app\models\PerfilUsuario::getPerfil(Yii::$app->user->id);

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice+9), strtoupper($perfil->a02_nombre).' '.strtoupper($perfil->a02_apaterno).' '.strtoupper($perfil->a02_amaterno));


    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "PCC_" . date('d-m-Y');
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    /**/
    $script = "
        var a = document.createElement('a');
		a.download = '" . $nombre . "';
		a.href = 'files/excel/" . $nombre . ".xlsx';
		a.click();

		";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');

}


//Reporte Control folios
//Entrega Documentación Tuberculosis
if($tipo==6) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $filtro = Yii::$app->request->get("filtro");
    $desde = Yii::$app->request->get("desde");
    $hasta = Yii::$app->request->get("hasta");

    //$arete_traza = 3529281;

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/Documentacion TB.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');

    if($filtro==0) {
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            *
            FROM p03_tb p03
            WHERE  p03.p03_flectura BETWEEN '" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio")->all();
    }else if($filtro==1) {
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            * 
            FROM p03_tb p03 
            JOIN r16_folios_medicos r16 ON r16.p03_id=p03.p03_id AND r16.r16_tipo_dictamen=1 AND r16.r16_estatus=1
            WHERE r16.r16_entregado=1 AND p03.p03_flectura BETWEEN'" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio")->all();
    }else if($filtro==2) {
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            * 
            FROM p03_tb p03 
            JOIN r16_folios_medicos r16 ON r16.p03_id=p03.p03_id AND r16.r16_tipo_dictamen=1 AND r16.r16_estatus=1
            WHERE r16.r16_entregado=0 AND p03.p03_flectura BETWEEN'" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio")->all();
    }else if($filtro==3) {
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            *
            FROM p03_tb p03
            WHERE  p03.p03_flectura BETWEEN '" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio is null")->all();
    }
    else if($filtro==4) {
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            *
            FROM p03_tb p03 
            JOIN r16_folios_medicos r16 ON r16.p03_id=p03.p03_id AND r16.r16_tipo_dictamen=1 AND r16.r16_estatus=1 AND r16.r16_fecha_folio
            WHERE TIMESTAMPDIFF(day, r16_fecha_folio,CURDATE()) >29 AND r16.r16_entregado=0")->all();
    }
    $estilo = $objPHPExcel->getActiveSheet()->getStyle('B4');
    $indice = 18;
    foreach ($cons as $p03) {
        //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, 2), "ARETE: " . $arete);
        $info_tb = Yii::$app->db->createCommand("
SELECT 
p03.p03_folio AS folio,
(select DATE_FORMAT(r16_fecha_folio, \"%d/%m/%Y\") from r16_folios_medicos r16 where r16_tipo_dictamen=1 and r16.p03_id=p03.p03_id and r16_estatus=1 LIMIT 1) AS fecha_entrega,
(select CONCAT(c05_nombre, ' ', c05_apaterno, ' ', c05_amaterno) from c05_mvz where c05_id=p03.c05_id) AS nombre_mvz,
(select c05_clave from c05_mvz where c05_id=p03.c05_id) AS clave_mvz,
IF(p03_tipoPrueba=1,\"PPC\",\"PCC\") AS tipo_prueba, 
DATE_FORMAT(p03_flectura, \"%d/%m/%Y\") AS fecha_lectura,
(select c15_descripcion from c15_zonas WHERE c15_id=r01.r01_zona) AS zona,
(SELECT c09_descrip FROM c09_funcion_zoo WHERE c09_id=p03.p03_funcZoo) AS funcion_zoo,
(select CONCAT(c01_nombre, ' ', c01_apaterno, ' ', c01_amaterno) from c01_ganaderos WHERE c01_id=p03.c01_id) AS productor,
CONCAT(r01.r01_calle, ' ', r01.r01_colonia) AS domicilio,
r01.r01_nombre AS predio,
(SELECT c04_nom_loc FROM c04_localidades_zac WHERE c04_id=r01.r01_localidad) AS poblacion,
r01.r01_clave AS upp,
(SELECT c03_nom_mun FROM c03_municipios WHERE c03_id=r01.r01_municipio) AS municipio,
IF(p03.p03_motivoPrueba=14 || p03.p03_motivoPrueba=26 || p03.p03_motivoPrueba=28, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS hato_libre,
IF(p03.p03_motivoPrueba=14 || p03.p03_motivoPrueba=26 || p03.p03_motivoPrueba=28, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6) ),0) AS hato_libre_pos,
IF(p03.p03_motivoPrueba=17, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS movilizacion,
IF(p03.p03_motivoPrueba=17, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6)),0) AS movilizacion_pos,
IF(p03.p03_motivoPrueba=22, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS prueba_hato,
IF(p03.p03_motivoPrueba=22, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6)),0) AS prueba_hato_pos,
IF(p03.p03_motivoPrueba=24, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS barrido,
IF(p03.p03_motivoPrueba=24, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6)),0) AS barrido_pos,
IF(p03.p03_motivoPrueba=20, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS minibarrido,
IF(p03.p03_motivoPrueba=20, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6)),0) AS minibarrido_pos,
IF(p03.p03_motivoPrueba=1, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS zona_buffer,
IF(p03.p03_motivoPrueba=1, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6)),0) AS zona_buffer_pos,

IF(p03.p03_motivoPrueba=16, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS mel,
IF(p03.p03_motivoPrueba=16, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6)),0) AS mel_pos,

IF(p03.p03_motivoPrueba=7, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS vigilancia,
IF(p03.p03_motivoPrueba=7, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6)),0) AS vigilancia_pos,
IF(p03.p03_motivoPrueba=6, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS inv,
IF(p03.p03_motivoPrueba=6, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6)),0) AS inv_pos,
IF(p03.p03_motivoPrueba=18, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS seguimiento,
IF(p03.p03_motivoPrueba=18, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6)),0) AS seguimiento_pos,
IF(p03.p03_motivoPrueba=15, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id),0) AS export,
IF(p03.p03_motivoPrueba=15, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND (r06_diagnostico=5 || r06_diagnostico=6)),0) AS export_pos,
if(r01.r01_latitud,r01.r01_latitud,'') AS latitud,
if(r01.r01_longitud, r01.r01_longitud, '') AS longitud,
(select if(r16_entregado=1,'Sí','No') from r16_folios_medicos r16 where r16_tipo_dictamen=1 and r16.p03_id=p03.p03_id and r16_estatus=1 LIMIT 1) AS recibido,
(select DATE_FORMAT(r16_fecha_entregado, \"%d/%m/%Y\") from r16_folios_medicos r16 where r16_tipo_dictamen=1 and r16.p03_id=p03.p03_id and r16_estatus=1 LIMIT 1) AS fecha_recibido,
(select DATE_FORMAT(r16_fecha_folio, \"%d/%m/%Y\") from r16_folios_medicos r16 where r16_tipo_dictamen=1 and r16.p03_id=p03.p03_id and r16_estatus=1 LIMIT 1) AS fecha_folio,
IF(p03_cc, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND r06_diagnostico=5 ),0) AS sospechosos_cc,
IF(p03_cc, (select COUNT(*) from r06_tuberculosis_aretes WHERE p03_tb=p03.p03_id AND r06_diagnostico=6 ),0) AS positivos_cc
FROM p03_tb p03 
INNER JOIN r01_upp r01 ON p03.r01_id=r01.r01_id
WHERE p03.p03_id=$p03->p03_id;
",[])->queryAll();
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $indice-17);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $info_tb[0]['folio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $info_tb[0]['fecha_entrega']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $info_tb[0]['nombre_mvz']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $info_tb[0]['clave_mvz']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $info_tb[0]['tipo_prueba']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $info_tb[0]['fecha_lectura']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $info_tb[0]['zona']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $info_tb[0]['funcion_zoo']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $info_tb[0]['productor']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $info_tb[0]['domicilio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), $info_tb[0]['predio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $info_tb[0]['poblacion']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $info_tb[0]['upp']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $info_tb[0]['municipio']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $info_tb[0]['hato_libre']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $info_tb[0]['hato_libre_pos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $info_tb[0]['movilizacion']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), $info_tb[0]['movilizacion_pos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $info_tb[0]['prueba_hato']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $info_tb[0]['prueba_hato_pos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $info_tb[0]['barrido']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $info_tb[0]['barrido_pos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(26, $indice), $info_tb[0]['minibarrido']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), $info_tb[0]['minibarrido_pos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(28, $indice), $info_tb[0]['zona_buffer']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(29, $indice), $info_tb[0]['zona_buffer_pos']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(30, $indice), $info_tb[0]['mel']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(31, $indice), $info_tb[0]['mel_pos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(32, $indice), $info_tb[0]['vigilancia']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(33, $indice), $info_tb[0]['vigilancia_pos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(34, $indice), $info_tb[0]['inv']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(35, $indice), $info_tb[0]['inv_pos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(36, $indice), $info_tb[0]['seguimiento']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(37, $indice), $info_tb[0]['seguimiento_pos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(38, $indice), $info_tb[0]['export']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(39, $indice), $info_tb[0]['export_pos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(40, $indice), $info_tb[0]['latitud']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(41, $indice), $info_tb[0]['longitud']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(43, $indice), $info_tb[0]['recibido']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(44, $indice), $info_tb[0]['fecha_recibido']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(45, $indice), $info_tb[0]['fecha_folio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(46, $indice), $info_tb[0]['sospechosos_cc']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(47, $indice), $info_tb[0]['positivos_cc']);
        $indice++;
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "DocumentacionTB_" .$desde."_".$hasta;
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');


}


//Reporte Control folios
//Entrega Documentación Brucelosis
if($tipo==7) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $filtro = Yii::$app->request->get("filtro");
    $desde = Yii::$app->request->get("desde");
    $hasta = Yii::$app->request->get("hasta");

    //$arete_traza = 3529281;

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/Documentacion BR.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');
    if($filtro==0) {
        $cons = \app\models\Brucelosis::findBySql("
            SELECT 
            *
            FROM p03_br p03
            WHERE  p03.p03_fmuestreo BETWEEN '" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio")->all();
    }else if($filtro==1) {
        $cons = \app\models\Brucelosis::findBySql("
            SELECT 
            * 
            FROM p03_br p03 
            JOIN r16_folios_medicos r16 ON r16.p03_id=p03.p03_id AND r16.r16_tipo_dictamen=2 AND r16.r16_estatus=1
            WHERE r16.r16_entregado=1 AND p03.p03_fmuestreo BETWEEN'" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio")->all();
    }else if($filtro==2) {
        $cons = \app\models\Brucelosis::findBySql("
            SELECT 
            * 
            FROM p03_br p03 
            JOIN r16_folios_medicos r16 ON r16.p03_id=p03.p03_id AND r16.r16_tipo_dictamen=2 AND r16.r16_estatus=1
            WHERE r16.r16_entregado=0 AND p03.p03_fmuestreo BETWEEN'" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio")->all();
    }else if($filtro==3) {
        $cons = \app\models\Brucelosis::findBySql("
            SELECT 
            *
            FROM p03_br p03
            WHERE  p03.p03_fmuestreo BETWEEN '" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio is null")->all();
    }else if($filtro==4) {
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            *
            FROM p03_br p03 
            JOIN r16_folios_medicos r16 ON r16.p03_id=p03.p03_id AND r16.r16_tipo_dictamen=2 AND r16.r16_estatus=1 AND r16.r16_fecha_folio
            WHERE TIMESTAMPDIFF(day, r16_fecha_folio,CURDATE()) >29 AND r16.r16_entregado=0")->all();
    }
    $estilo = $objPHPExcel->getActiveSheet()->getStyle('B4');
    $indice = 12;
    foreach ($cons as $p03) {
        //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, 2), "ARETE: " . $arete);
        $info_br = Yii::$app->db->createCommand("
SELECT 
p03.p03_folio AS folio,
p03.p03_nocaso AS no_caso,
(select a02_nombre from a02_usudatos where a02_islab and a01_id=p03.p03_laboratorio) as laboratorio,
(select DATE_FORMAT(r16_fecha_folio, \"%d/%m/%Y\") from r16_folios_medicos r16 where r16_tipo_dictamen=2 and r16.p03_id=p03.p03_id and r16_estatus=1 ORDER BY r16_fecAlta DESC LIMIT 1) AS fecha_entrega,
(select CONCAT(c05_nombre, ' ', c05_apaterno, ' ', c05_amaterno) from c05_mvz where c05_id=p03.c05_id) AS nombre_mvz,
(select c05_clave from c05_mvz where c05_id=p03.c05_id) AS clave_mvz,
(select c08_descripcion from c08_tipo_prueba where c08_id=p03_tipoPrueba) AS tipo_prueba,
DATE_FORMAT(p03_fmuestreo, \"%d/%m/%Y\") AS fecha_muestreo,
(select c15_descripcion from c15_zonas WHERE c15_id=r01.r01_zona) AS zona,
if((select r02_especie from r02_aretes where r02_id=(select r02_id from r07_brucelosis_aretes where p03_br=p03.p03_id limit 1))=1,'BOVINOS', if((select r02_especie from r02_aretes where r02_id=(select r02_id from r07_brucelosis_aretes where p03_br=p03.p03_id limit 1))=2,'CAPRINOS', 'OVINOS')) as especie,
(SELECT c09_descrip FROM c09_funcion_zoo WHERE c09_id=p03.p03_funcZoo) AS funcion_zoo,
(select CONCAT(c01_nombre, ' ', c01_apaterno, ' ', c01_amaterno) from c01_ganaderos WHERE c01_id=p03.c01_id) AS productor,
CONCAT(r01.r01_calle, ' ', r01.r01_colonia) AS domicilio,
r01.r01_nombre AS predio,
(SELECT c04_nom_loc FROM c04_localidades_zac WHERE c04_id=r01.r01_localidad) AS poblacion,
r01.r01_clave AS upp,
(SELECT c03_nom_mun FROM c03_municipios WHERE c03_id=r01.r01_municipio) AS municipio,
IF((p03.p03_motivoPrueba=9 || p03.p03_motivoPrueba=13 || p03.p03_motivoPrueba=27 || p03.p03_motivoPrueba=29 || p03.p03_motivoPrueba=103), (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado!=17),0) AS hato_libre,
IF((p03.p03_motivoPrueba=9 || p03.p03_motivoPrueba=13 || p03.p03_motivoPrueba=27 || p03.p03_motivoPrueba=29 || p03.p03_motivoPrueba=103) AND p03.p03_rv is null AND p03.p03_fj is null, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=2 AND r07_resultado!=17),0) AS hato_libre_tarj,
IF((p03.p03_motivoPrueba=9 || p03.p03_motivoPrueba=13 || p03.p03_motivoPrueba=27 || p03.p03_motivoPrueba=29 || p03.p03_motivoPrueba=103) AND p03.p03_rv, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado!=8 AND r07_resultado!=17),0) AS hato_libre_riv,
IF((p03.p03_motivoPrueba=9 || p03.p03_motivoPrueba=13 || p03.p03_motivoPrueba=27 || p03.p03_motivoPrueba=29 || p03.p03_motivoPrueba=103) AND p03.p03_fj, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=13 AND r07_resultado!=17),0) AS hato_libre_fij,

IF(p03.p03_motivoPrueba=12, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id),0) AS movilizacion,
IF(p03.p03_motivoPrueba=12 AND p03.p03_rv is null AND p03.p03_fj is null, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=2 AND r07_resultado!=17),0) AS movilizacion_tarj,
IF(p03.p03_motivoPrueba=12 AND p03.p03_rv, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado!=8 AND r07_resultado!=17),0) AS movilizacion_riv,
IF(p03.p03_motivoPrueba=12 AND p03.p03_fj, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=13 AND r07_resultado!=17),0) AS movilizacion_fij,

IF(p03.p03_motivoPrueba=23, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado!=17),0) AS prueba_hato,
IF(p03.p03_motivoPrueba=23 AND p03.p03_rv is null AND p03.p03_fj is null, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=2 AND r07_resultado!=17),0) AS prueba_hato_tarj,
IF(p03.p03_motivoPrueba=23 AND p03.p03_rv, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado!=8 AND r07_resultado!=17),0) AS prueba_hato_riv,
IF(p03.p03_motivoPrueba=23 AND p03.p03_fj, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=13 AND r07_resultado!=17),0) AS prueba_hato_fij,

IF(p03.p03_motivoPrueba=19, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado!=17),0) AS seguimiento,
IF(p03.p03_motivoPrueba=19 AND p03.p03_rv is null AND p03.p03_fj is null, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=2 AND r07_resultado!=17),0) AS seguimiento_tarj,
IF(p03.p03_motivoPrueba=19 AND p03.p03_rv, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado!=8 AND r07_resultado!=17),0) AS seguimiento_riv,
IF(p03.p03_motivoPrueba=19 AND p03.p03_fj, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=13 AND r07_resultado!=17),0) AS seguimiento_fij,

IF(p03.p03_motivoPrueba=25, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado!=17),0) AS barrido,
IF(p03.p03_motivoPrueba=25 AND p03.p03_rv is null AND p03.p03_fj is null, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=2 AND r07_resultado!=17),0) AS barrido_tarj,
IF(p03.p03_motivoPrueba=25 AND p03.p03_rv, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado!=8 AND r07_resultado!=17),0) AS barrido_riv,
IF(p03.p03_motivoPrueba=25 AND p03.p03_fj, (select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=13 AND r07_resultado!=17),0) AS barrido_fij,

IFNULL(p03_totalHato,(select count(*) from r07_brucelosis_aretes where p03_br=p03.p03_id)) AS total_hato,
(select COUNT(*) from r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado=3) AS hemolizadas,
if(r01.r01_latitud,r01.r01_latitud,'') AS latitud,
if(r01.r01_longitud, r01.r01_longitud, '') AS longitud,

(select if(r16_entregado=1,'Sí','No') from r16_folios_medicos r16 where r16_tipo_dictamen=2 and r16.p03_id=p03.p03_id and r16_estatus=1 ORDER BY r16_fecAlta DESC LIMIT 1) AS recibido,
(select DATE_FORMAT(r16_fecha_entregado, \"%d/%m/%Y\") from r16_folios_medicos r16 where r16_tipo_dictamen=2 and r16.p03_id=p03.p03_id and r16_estatus=1 ORDER BY r16_fecAlta DESC LIMIT 1) AS fecha_recibido,
(select DATE_FORMAT(r16_fecha_folio, \"%d/%m/%Y\") from r16_folios_medicos r16 where r16_tipo_dictamen=2 and r16.p03_id=p03.p03_id and r16_estatus=1 ORDER BY r16_fecAlta DESC LIMIT 1) AS fecha_folio

FROM p03_br p03 
INNER JOIN r01_upp r01 ON p03.r01_id=r01.r01_id
WHERE p03.p03_id=$p03->p03_id;
",[])->queryAll();
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $indice-11);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $info_br[0]['folio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $info_br[0]['no_caso']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $info_br[0]['laboratorio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $info_br[0]['fecha_entrega']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $info_br[0]['nombre_mvz']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $info_br[0]['clave_mvz']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $info_br[0]['tipo_prueba']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $info_br[0]['fecha_muestreo']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $info_br[0]['zona']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $info_br[0]['especie']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), $info_br[0]['funcion_zoo']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $info_br[0]['productor']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $info_br[0]['domicilio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $info_br[0]['predio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $info_br[0]['poblacion']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $info_br[0]['upp']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $info_br[0]['municipio']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), $info_br[0]['hato_libre']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $info_br[0]['hato_libre_tarj']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $info_br[0]['hato_libre_riv']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $info_br[0]['hato_libre_fij']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $info_br[0]['movilizacion']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(26, $indice), $info_br[0]['movilizacion_tarj']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), $info_br[0]['movilizacion_riv']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(28, $indice), $info_br[0]['movilizacion_fij']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(29, $indice), $info_br[0]['prueba_hato']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(30, $indice), $info_br[0]['prueba_hato_tarj']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(31, $indice), $info_br[0]['prueba_hato_riv']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(32, $indice), $info_br[0]['prueba_hato_fij']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(33, $indice), $info_br[0]['seguimiento']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(34, $indice), $info_br[0]['seguimiento_tarj']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(35, $indice), $info_br[0]['seguimiento_riv']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(36, $indice), $info_br[0]['seguimiento_fij']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(37, $indice), $info_br[0]['barrido']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(38, $indice), $info_br[0]['barrido_tarj']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(39, $indice), $info_br[0]['barrido_riv']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(40, $indice), $info_br[0]['barrido_fij']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(41, $indice), $info_br[0]['total_hato']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(42, $indice), $info_br[0]['hemolizadas']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(43, $indice), $info_br[0]['latitud']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(44, $indice), $info_br[0]['longitud']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(46, $indice), $info_br[0]['recibido']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(47, $indice), $info_br[0]['fecha_recibido']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(48, $indice), $info_br[0]['fecha_folio']);
        $indice++;
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "DocumentacionBR_" .$desde."_".$hasta;
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');


}

if($tipo==8) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $desde_ppc = Yii::$app->request->get("desde");
    $hasta_ppc = Yii::$app->request->get("hasta");
    $actual_pcc = Yii::$app->request->get("act", Utileria::getFechaActualOnly());
    $meds = \app\models\Medicos::findBySql(
        "
SELECT 
*
FROM c05_mvz 
WHERE c05_id IN (SELECT c05_id FROM p03_tb p03 INNER JOIN r01_upp r01 ON p03.r01_id=r01.r01_id  WHERE p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND r01.r01_zona=1 AND p03.p03_isdictaminado=1);")->all();

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/pcaudal.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, 18), $desde_ppc.' - '.$hasta_ppc);
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, 19), $actual_pcc);

    setlocale(LC_CTYPE, 'de_DE.UTF8');


    $estilo = $objPHPExcel->getActiveSheet()->getStyle('B4');
    $indice = 28;
    foreach ($meds as $m) {
        $info_dic = Yii::$app->db->createCommand("
SELECT
c05_id AS medico,
(SELECT CONCAT(IFNULL(c05_nombre,''), ' ', IFNULL(c05_apaterno,''), ' ', IFNULL(c05_amaterno,'')) FROM c05_mvz c05 WHERE c05.c05_id=p03.c05_id) AS nombre_mvz,
(SELECT c05_clave FROM c05_mvz c05 WHERE c05.c05_id=p03.c05_id) AS clave_mvz,
(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona=1 AND p.p03_motivoPrueba=24 AND p.p03_isdictaminado=1) AS barrido_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=24)) AS barrido_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=24 AND r06.r06_diagnostico=6)) AS barrido_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona=1 AND p.p03_motivoPrueba=18 AND p.p03_isdictaminado=1) AS segui_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=18)) AS segui_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=18 AND r06.r06_diagnostico=6)) AS segui_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona=1 AND p.p03_motivoPrueba=15 AND p.p03_isdictaminado=1) AS exp_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=15)) AS exp_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=15 AND r06.r06_diagnostico=6)) AS exp_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona=1 AND p.p03_motivoPrueba=17 AND p.p03_isdictaminado=1) AS mov_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=17)) AS mov_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=17 AND r06.r06_diagnostico=6)) AS mov_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona=1 AND p.p03_motivoPrueba=14 AND p.p03_isdictaminado=1) AS libres_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=14)) AS libres_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=14 AND r06.r06_diagnostico=6)) AS libres_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona=1 AND p.p03_motivoPrueba=1 AND p.p03_isdictaminado=1) AS zona_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=1)) AS zona_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=1 AND r06.r06_diagnostico=6)) AS zona_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona=1 AND (p.p03_motivoPrueba!=24 && p.p03_motivoPrueba!=18 && p.p03_motivoPrueba!=15 && p.p03_motivoPrueba!=17 && p.p03_motivoPrueba!=14 && p.p03_motivoPrueba!=1) AND p.p03_isdictaminado=1) AS otros_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND (p03.p03_motivoPrueba!=24 && p03.p03_motivoPrueba!=18 && p03.p03_motivoPrueba!=15 && p03.p03_motivoPrueba!=17 && p03.p03_motivoPrueba!=14 && p03.p03_motivoPrueba!=1))) AS otros_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND (p03.p03_motivoPrueba!=24 && p03.p03_motivoPrueba!=18 && p03.p03_motivoPrueba!=15 && p03.p03_motivoPrueba!=17 && p03.p03_motivoPrueba!=14 && p03.p03_motivoPrueba!=1) AND r06.r06_diagnostico=6)) AS otros_reac
FROM p03_tb p03
INNER JOIN r01_upp r01 ON p03.r01_id=r01.r01_id  
WHERE p03.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p03.c05_id=$m->c05_id AND r01.r01_zona=1 AND p03.p03_isdictaminado=1
",[])->queryAll();

        $estilo = $objPHPExcel->getActiveSheet()->getStyle('A28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(1, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $indice-27);

        /*Medio*/
        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(2, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $info_dic[0]['nombre_mvz']);

        /*Derecha*/
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(3, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $info_dic[0]['clave_mvz']);

        /*Izquierda*/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');

        /**
         * BARRIDO
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(4, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $info_dic[0]['barrido_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(5, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $info_dic[0]['barrido_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(6, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $info_dic[0]['barrido_reac']);

        $tasa=0;
        if($info_dic[0]['barrido_pruebas']>0)
            $tasa = $info_dic[0]['barrido_reac']/$info_dic[0]['barrido_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(7, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * SEGUIMIENTOS EPIDEMIOLOGICOS
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(8, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $info_dic[0]['segui_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(9, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $info_dic[0]['segui_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(10, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $info_dic[0]['segui_reac']);

        $tasa=0;
        if($info_dic[0]['segui_pruebas']>0)
            $tasa = $info_dic[0]['segui_reac']/$info_dic[0]['segui_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(11, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * EXPORTACION
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(12, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $info_dic[0]['exp_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(13, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $info_dic[0]['exp_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(14, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), $info_dic[0]['exp_reac']);

        $tasa=0;
        if($info_dic[0]['exp_pruebas']>0)
            $tasa = $info_dic[0]['exp_reac']/$info_dic[0]['exp_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(15, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * MOVILIZACIÓN
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(16, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $info_dic[0]['mov_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(17, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $info_dic[0]['mov_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(18, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $info_dic[0]['mov_reac']);

        $tasa=0;
        if($info_dic[0]['mov_pruebas']>0)
            $tasa = $info_dic[0]['mov_reac']/$info_dic[0]['mov_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(19, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * HATOS LIBRES
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(20, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $info_dic[0]['libres_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(21, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), $info_dic[0]['libres_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(22, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $info_dic[0]['libres_reac']);

        $tasa=0;
        if($info_dic[0]['libres_pruebas']>0)
            $tasa = $info_dic[0]['libres_reac']/$info_dic[0]['libres_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(23, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * ZONA BUFFER
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(24, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $info_dic[0]['zona_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(25, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $info_dic[0]['zona_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(26, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(26, $indice), $info_dic[0]['zona_reac']);

        $tasa=0;
        if($info_dic[0]['zona_pruebas']>0)
            $tasa = $info_dic[0]['zona_reac']/$info_dic[0]['zona_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(27, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * OTRAS
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(28, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(28, $indice), $info_dic[0]['otros_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(29, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(29, $indice), $info_dic[0]['otros_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(30, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(30, $indice), $info_dic[0]['otros_reac']);

        $tasa=0;
        if($info_dic[0]['otros_pruebas']>0)
            $tasa = $info_dic[0]['otros_reac']/$info_dic[0]['otros_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(31, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(31, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * TOTALES
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(32, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(32, $indice), '=SUM(D'.$indice.'+H'.$indice.'+L'.$indice.'+P'.$indice.'+T'.$indice.'+X'.$indice.'+AB'.$indice.')');

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(33, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(33, $indice), '=SUM(E'.$indice.',I'.$indice.',M'.$indice.',Q'.$indice.',U'.$indice.',Y'.$indice.',AC'.$indice.')');

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(34, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(34, $indice), '=SUM(F'.$indice.',J'.$indice.',N'.$indice.',R'.$indice.',V'.$indice.',Z'.$indice.',AD'.$indice.')');

        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(35, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(35, $indice), '=SUM(G'.$indice.'+K'.$indice.'+O'.$indice.'+S'.$indice.'+W'.$indice.'+AA'.$indice.'+AE'.$indice.')');

        $objPHPExcel->getActiveSheet()->insertNewRowBefore($indice+1, 1);
        $indice++;
    }
    /**
     * TOTAL A
     **/
    $indice++;
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), '=SUM(D28:D'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), '=SUM(E28:E'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), '=SUM(H28:H'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), '=SUM(I28:I'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), '=SUM(J28:J'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), '=SUM(L28:L'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), '=SUM(M28:M'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), '=SUM(N28:N'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), '=SUM(P28:P'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), '=SUM(Q28:Q'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), '=SUM(R28:R'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), '=SUM(T28:T'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), '=SUM(U28:U'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), '=SUM(V28:V'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), '=SUM(X28:X'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), '=SUM(Y28:Y'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(26, $indice), '=SUM(Z28:Z'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(28, $indice), '=SUM(ABT28:AB'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(29, $indice), '=SUM(AC28:AC'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(30, $indice), '=SUM(AD28:AD'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(32, $indice), '=SUM(AF28:AF'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(33, $indice), '=SUM(AG28:AG'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(34, $indice), '=SUM(AH28:AH'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $indice++;

    /******************
     ************ZONA B
     ******************/
    $meds = \app\models\Medicos::findBySql(
        "
SELECT 
* 
FROM c05_mvz 
WHERE c05_id IN (SELECT c05_id FROM p03_tb p03 INNER JOIN r01_upp r01 ON p03.r01_id=r01.r01_id  WHERE p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND r01.r01_zona!=1 AND p03.p03_isdictaminado=1);")->all();

    foreach ($meds as $m) {
        $info_dic = Yii::$app->db->createCommand("
SELECT
c05_id AS medico,
(SELECT CONCAT(IFNULL(c05_nombre,''), ' ', IFNULL(c05_apaterno,''), ' ', IFNULL(c05_amaterno,'')) FROM c05_mvz c05 WHERE c05.c05_id=p03.c05_id) AS nombre_mvz,
(SELECT c05_clave FROM c05_mvz c05 WHERE c05.c05_id=p03.c05_id) AS clave_mvz,
(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona!=1 AND p.p03_motivoPrueba=24 AND p.p03_isdictaminado=1) AS barrido_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=24)) AS barrido_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=24 AND r06.r06_diagnostico=6)) AS barrido_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona!=1 AND p.p03_motivoPrueba=18 AND p.p03_isdictaminado=1) AS segui_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=18)) AS segui_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=18 AND r06.r06_diagnostico=6)) AS segui_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona!=1 AND p.p03_motivoPrueba=15 AND p.p03_isdictaminado=1) AS exp_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=15)) AS exp_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=15 AND r06.r06_diagnostico=6)) AS exp_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona!=1 AND p.p03_motivoPrueba=17 AND p.p03_isdictaminado=1) AS mov_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=17)) AS mov_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=17 AND r06.r06_diagnostico=6)) AS mov_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona!=1 AND p.p03_motivoPrueba=14 AND p.p03_isdictaminado=1) AS libres_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=14)) AS libres_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=14 AND r06.r06_diagnostico=6)) AS libres_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona!=1 AND p.p03_motivoPrueba=1 AND p.p03_isdictaminado=1) AS zona_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=1)) AS zona_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND p03.p03_motivoPrueba=1 AND r06.r06_diagnostico=6)) AS zona_reac,

(SELECT COUNT(*) FROM p03_tb p INNER JOIN r01_upp r ON p.r01_id=r.r01_id   WHERE p.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p.c05_id=$m->c05_id AND r.r01_zona!=1 AND (p.p03_motivoPrueba!=24 && p.p03_motivoPrueba!=18 && p.p03_motivoPrueba!=15 && p.p03_motivoPrueba!=17 && p.p03_motivoPrueba!=14 && p.p03_motivoPrueba!=1) AND p.p03_isdictaminado=1) AS otros_hatos,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND (p03.p03_motivoPrueba!=24 && p03.p03_motivoPrueba!=18 && p03.p03_motivoPrueba!=15 && p03.p03_motivoPrueba!=17 && p03.p03_motivoPrueba!=14 && p03.p03_motivoPrueba!=1))) AS otros_pruebas,
SUM((SELECT count(*) FROM r06_tuberculosis_aretes r06 WHERE r06.p03_tb=p03.p03_id AND (p03.p03_motivoPrueba!=24 && p03.p03_motivoPrueba!=18 && p03.p03_motivoPrueba!=15 && p03.p03_motivoPrueba!=17 && p03.p03_motivoPrueba!=14 && p03.p03_motivoPrueba!=1) AND r06.r06_diagnostico=6)) AS otros_reac
FROM p03_tb p03
INNER JOIN r01_upp r01 ON p03.r01_id=r01.r01_id  
WHERE p03.p03_flectura BETWEEN '".$desde_ppc."' AND '".$hasta_ppc."' AND p03.c05_id=$m->c05_id AND r01.r01_zona!=1 AND p03.p03_isdictaminado=1
",[])->queryAll();

        $estilo = $objPHPExcel->getActiveSheet()->getStyle('A28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo, Utileria::getCelda(1, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $indice-27);

        /*Medio*/
        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(2, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $info_dic[0]['nombre_mvz']);

        /*Derecha*/
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(3, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $info_dic[0]['clave_mvz']);

        /*Izquierda*/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');

        /**
         * BARRIDO
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(4, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $info_dic[0]['barrido_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(5, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $info_dic[0]['barrido_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(6, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $info_dic[0]['barrido_reac']);

        $tasa=0;
        if($info_dic[0]['barrido_pruebas']>0)
            $tasa = $info_dic[0]['barrido_reac']/$info_dic[0]['barrido_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(7, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * SEGUIMIENTOS EPIDEMIOLOGICOS
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(8, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $info_dic[0]['segui_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(9, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $info_dic[0]['segui_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(10, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $info_dic[0]['segui_reac']);

        $tasa=0;
        if($info_dic[0]['segui_pruebas']>0)
            $tasa = $info_dic[0]['segui_reac']/$info_dic[0]['segui_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(11, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * EXPORTACION
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(12, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $info_dic[0]['exp_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(13, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $info_dic[0]['exp_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(14, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), $info_dic[0]['exp_reac']);

        $tasa=0;
        if($info_dic[0]['exp_pruebas']>0)
            $tasa = $info_dic[0]['exp_reac']/$info_dic[0]['exp_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(15, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * MOVILIZACIÓN
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(16, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $info_dic[0]['mov_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(17, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $info_dic[0]['mov_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(18, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $info_dic[0]['mov_reac']);

        $tasa=0;
        if($info_dic[0]['mov_pruebas']>0)
            $tasa = $info_dic[0]['mov_reac']/$info_dic[0]['mov_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(19, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * HATOS LIBRES
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(20, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $info_dic[0]['libres_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(21, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), $info_dic[0]['libres_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(22, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $info_dic[0]['libres_reac']);

        $tasa=0;
        if($info_dic[0]['libres_pruebas']>0)
            $tasa = $info_dic[0]['libres_reac']/$info_dic[0]['libres_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(23, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * ZONA BUFFER
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(24, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $info_dic[0]['zona_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(25, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $info_dic[0]['zona_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(26, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(26, $indice), $info_dic[0]['zona_reac']);

        $tasa=0;
        if($info_dic[0]['zona_pruebas']>0)
            $tasa = $info_dic[0]['zona_reac']/$info_dic[0]['zona_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(27, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * OTRAS
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(28, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(28, $indice), $info_dic[0]['otros_hatos']);

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(29, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(29, $indice), $info_dic[0]['otros_pruebas']);

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(30, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(30, $indice), $info_dic[0]['otros_reac']);

        $tasa=0;
        if($info_dic[0]['otros_pruebas']>0)
            $tasa = $info_dic[0]['otros_reac']/$info_dic[0]['otros_pruebas']*100;
        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(31, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(31, $indice), round($tasa,3, PHP_ROUND_HALF_UP));

        /**
         * TOTALES
         **/
        $estilo_izq = $objPHPExcel->getActiveSheet()->getStyle('D28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_izq, Utileria::getCelda(32, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(32, $indice), '=SUM(D'.$indice.'+H'.$indice.'+L'.$indice.'+P'.$indice.'+T'.$indice.'+X'.$indice.'+AB'.$indice.')');

        $estilo_med = $objPHPExcel->getActiveSheet()->getStyle('B28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(33, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(33, $indice), '=SUM(E'.$indice.',I'.$indice.',M'.$indice.',Q'.$indice.',U'.$indice.',Y'.$indice.',AC'.$indice.')');

        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_med, Utileria::getCelda(34, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(34, $indice), '=SUM(F'.$indice.',J'.$indice.',N'.$indice.',R'.$indice.',V'.$indice.',Z'.$indice.',AD'.$indice.')');

        $estilo_der = $objPHPExcel->getActiveSheet()->getStyle('C28');
        $objPHPExcel->getActiveSheet()->duplicateStyle($estilo_der, Utileria::getCelda(35, $indice));
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(35, $indice), '=SUM(G'.$indice.'+K'.$indice.'+O'.$indice.'+S'.$indice.'+W'.$indice.'+AA'.$indice.'+AE'.$indice.')');

        $objPHPExcel->getActiveSheet()->insertNewRowBefore($indice+1, 1);
        $indice++;
    }

    /**
     * TOTAL B
     **/
    $indice++;
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), '=SUM(D31:D'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), '=SUM(E31:E'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F31:F'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), '=SUM(H31:H'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), '=SUM(I31:I'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), '=SUM(J31:J'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), '=SUM(L31:L'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), '=SUM(M31:M'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), '=SUM(N31:N'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), '=SUM(P31:P'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), '=SUM(Q31:Q'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), '=SUM(R31:R'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), '=SUM(T31:T'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), '=SUM(U31:U'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), '=SUM(V31:V'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), '=SUM(X31:X'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), '=SUM(Y31:Y'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(26, $indice), '=SUM(Z31:Z'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(28, $indice), '=SUM(ABT31:AB'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(29, $indice), '=SUM(AC31:AC'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(30, $indice), '=SUM(AD31:AD'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');

    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(32, $indice), '=SUM(AF31:AF'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(33, $indice), '=SUM(AG31:AG'.($indice-2).')');
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(34, $indice), '=SUM(AH31:AH'.($indice-2).')');
    //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), '=SUM(F28:F'.($indice-2).')');



    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "PPC_" . date('d-m-Y');
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');

}

/*
 *
 * Inicio Rreporte de laboratorio - informe
 *
 * */
if($tipo==9) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $desde_lab = Yii::$app->request->get("desde");
    $hasta_lab = Yii::$app->request->get("hasta");

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/Informe.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');

    $casos = \app\models\Brucelosis::findBySql(
        "
SELECT 
* 
FROM p03_br
WHERE p03_isdictaminado AND p03_nocaso AND p03_fj is null AND p03_frecepcion BETWEEN '".$desde_lab."' AND '".$hasta_lab."'
GROUP BY p03_nocaso, p03_laboratorio
ORDER BY p03_nocaso")->all();

    $indice = 8;
    /*
     *
     * Inicio ciclo por número de casos agrupados por caso y laboratorio
     *
     * */
    foreach ($casos as $c) {
        $registros = \app\models\Brucelosis::findBySql("
SELECT 
*
FROM p03_br p03
WHERE p03_dictamenAnt is null AND p03.p03_nocaso=$c->p03_nocaso AND p03_fj is null AND p03.p03_laboratorio=$c->p03_laboratorio AND (YEAR(p03_frecepcion)=('".$desde_lab."') || YEAR(p03_frecepcion)=('".$hasta_lab."') ) AND p03_frecepcion BETWEEN '".$desde_lab."' AND '".$hasta_lab."'
",[])->all();

        $cont_reg = 0;
        $carne = 0;
        $leche = 0;
        $mixto = 0;

        $bovinos = 0;
        $ovinos = 0;
        $caprinos = 0;

        $prueba_hato = 0;
        $movil_interna = 0;
        $hato_libre = 0;
        $ps = 0;
        $ml = 0;
        $mr = 0;
        $cr = 0;
        $se = 0;

        $hemolizadas = 0;
        $pos_ovi = 0;
        $pos_bovino = 0;
        $pos_rivanol = 0;

        $total_pos = 0;
        $total_neg = 0;

        foreach ($registros as $r) {

            $info_dic = Yii::$app->db->createCommand("
SELECT 
(SELECT a02_nombre FROM a02_usudatos WHERE a02_islab=1 AND a02_id=p03_laboratorio) AS laboratorio,
p03_nocaso AS caso, 
DATE_FORMAT(p03_fmuestreo, \"%Y-%m-%d\") AS fecha_muestreo, 
DATE_FORMAT(p03_frecepcion, \"%Y-%m-%d\") AS fecha_recepcion, 
DATE_FORMAT(p03_fecha, \"%Y-%m-%d\") AS fecha_prueba, 
(SELECT CONCAT(IFNULL(c01_nombre,''), ' ', IFNULL(c01_apaterno,''), ' ', IFNULL(c01_amaterno,'')) from c01_ganaderos c01 WHERE c01.c01_id=p03.c01_id) AS propietario,
(SELECT CONCAT(IFNULL(c05_nombre,''), ' ', IFNULL(c05_apaterno,''), ' ', IFNULL(c05_amaterno,'')) from c05_mvz c05 WHERE c05.c05_id=p03.c05_id) AS medico,
(SELECT c02_nom_ent FROM c02_estados c02 WHERE c02.c02_cve_ent=r01.r01_estado) AS estado,
IFNULL((SELECT c03_nom_mun FROM c03_municipios c03 WHERE c03.c03_id=r01.r01_municipio),'') AS municipio,
IFNULL((select r01_nombre from r01_upp r01 where r01.r01_id=p03.r01_id) ,'') AS explotacion,
IF(p03_funcZoo=2,(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 WHERE r07.p03_br=p03.p03_id AND r07.r07_resultado!=17),0) AS carne,
IF(p03_funcZoo=1,(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 WHERE r07.p03_br=p03.p03_id AND r07.r07_resultado!=17),0) AS leche,
IF(p03_funcZoo=3,(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 WHERE r07.p03_br=p03.p03_id AND r07.r07_resultado!=17),0) AS mixto,
(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 INNER JOIN r02_aretes r02 ON r02.r02_id=r07.r02_id WHERE r02.r02_especie=1 AND r07.p03_br=p03.p03_id AND r07.r07_resultado!=17) AS bovinos,
(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 INNER JOIN r02_aretes r02 ON r02.r02_id=r07.r02_id WHERE r02.r02_especie=3 AND r07.p03_br=p03.p03_id AND r07.r07_resultado!=17) AS ovinos,
(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 INNER JOIN r02_aretes r02 ON r02.r02_id=r07.r02_id WHERE r02.r02_especie=2 AND r07.p03_br=p03.p03_id AND r07.r07_resultado!=17) AS caprinos,
IF((p03_motivoPrueba=10 || p03_motivoPrueba=11 || p03_motivoPrueba=21 || p03_motivoPrueba=23 || p03_motivoPrueba=25 || p03_motivoPrueba=101),(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 WHERE r07.p03_br=p03.p03_id AND r07.r07_resultado!=17),0) AS prueba_hato,
IF(p03_motivoPrueba=12 ,(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 WHERE r07.p03_br=p03.p03_id AND r07.r07_resultado!=17),0) AS movil_interna,
IF((p03_motivoPrueba=9 || p03_motivoPrueba=13 || p03_motivoPrueba=27 || p03_motivoPrueba=29 || p03_motivoPrueba=103) ,(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 WHERE r07.p03_br=p03.p03_id AND r07.r07_resultado!=17),0) AS hato_libre,
0 AS ps,
0 AS ml,
0 AS mr,
0 AS cr,
IF(p03_motivoPrueba=19 ,SUM((SELECT COUNT(*) FROM r07_brucelosis_aretes r07 WHERE r07.p03_br=p03.p03_id AND r07.r07_resultado!=17)),0) AS se,
(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 WHERE r07.p03_br=p03.p03_id AND r07.r07_resultado=3) AS hemolizadas,
(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 INNER JOIN r02_aretes r02 ON r02.r02_id=r07.r02_id WHERE (r02.r02_especie=2 || r02.r02_especie=3) AND r07.p03_br=p03.p03_id AND r07.r07_resultado=2) AS pos_tarjeta_ovi_capi,
(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 INNER JOIN r02_aretes r02 ON r02.r02_id=r07.r02_id WHERE r02.r02_especie=1 AND r07.p03_br=p03.p03_id AND r07.r07_resultado=2) AS pos_tarjeta_bovino,
(SELECT COUNT(*) FROM r07_brucelosis_aretes r07 WHERE r07.p03_br=p03.p03_id AND (r07.r07_rivanol=9 || r07.r07_rivanol=10 || r07.r07_rivanol=11 || r07.r07_rivanol=26 || r07.r07_rivanol=27 || r07.r07_rivanol=28 || r07.r07_rivanol=29)) AS pos_rivanol
FROM p03_br p03
INNER JOIN r01_upp r01 ON r01.r01_id=p03.r01_id 
WHERE p03.p03_id=$r->p03_id 
LIMIT 1
",[])->queryAll();

            $carne += $info_dic[0]['carne'];
            $leche += $info_dic[0]['leche'];
            $mixto += $info_dic[0]['mixto'];

            $bovinos += $info_dic[0]['bovinos'];
            $ovinos += $info_dic[0]['ovinos'];
            $caprinos +=$info_dic[0]['caprinos'];

            $prueba_hato += $info_dic[0]['prueba_hato'];
            $movil_interna += $info_dic[0]['movil_interna'];
            $hato_libre += $info_dic[0]['hato_libre'];
            $ps += $info_dic[0]['ps'];
            $ml += $info_dic[0]['ml'];
            $mr += $info_dic[0]['mr'];
            $cr += $info_dic[0]['cr'];
            $se += $info_dic[0]['se'];

            $hemolizadas += $info_dic[0]['hemolizadas'];
            $pos_ovi += $info_dic[0]['pos_tarjeta_ovi_capi'];
            $pos_bovino += $info_dic[0]['pos_tarjeta_bovino'];
            $pos_rivanol += $info_dic[0]['pos_rivanol'];

            /*
         * inicio cálculo del total de positivos
         * */
            //sumar ovinos y caprinos
            $tota_pos_borr = $info_dic[0]['pos_tarjeta_ovi_capi'];
            $total_pos += $info_dic[0]['pos_tarjeta_ovi_capi'];
            //sumar bovinos
            if($info_dic[0]['pos_rivanol']>0){
                $total_pos += $info_dic[0]['pos_rivanol'];
                $tota_pos_borr += $info_dic[0]['pos_rivanol'];
            }
            else{
                //$total_pos += $info_dic[0]['pos_tarjeta_bovino'];
                $tota_pos_borr += $info_dic[0]['pos_tarjeta_bovino'];

            }
            /*
             * fin cálculo del total de positivos
            */

            /*
             * Inicio calculo de negativos
             * */
            $total_neg += $info_dic[0]['bovinos'];
            $total_neg += $info_dic[0]['ovinos'];
            $total_neg += $info_dic[0]['caprinos'];
            $total_neg -= $tota_pos_borr + $info_dic[0]['hemolizadas'];

            /*
             * Fin calculo de negativos
             * */

            $cont_reg++;
            /*Probar por registro
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice+$cont_reg), $info_dic[0]['hemolizadas'] );
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(26, $indice+$cont_reg), $info_dic[0]['pos_tarjeta_ovi_capi'] );
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice+$cont_reg), $info_dic[0]['pos_tarjeta_bovino'] );
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(28, $indice+$cont_reg), $info_dic[0]['pos_rivanol'] );
            */
        }

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $info_dic[0]['laboratorio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $info_dic[0]['caso']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $info_dic[0]['fecha_muestreo']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $info_dic[0]['fecha_recepcion']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $info_dic[0]['fecha_prueba']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $info_dic[0]['propietario']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $info_dic[0]['medico']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $info_dic[0]['estado']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $info_dic[0]['municipio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $info_dic[0]['explotacion']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $carne);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $leche);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $mixto);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), $bovinos );
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $ovinos);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $caprinos);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $prueba_hato);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $movil_interna);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $hato_libre);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $ps );
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), $ml );
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $mr );
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $cr );
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $se );

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $hemolizadas );
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(26, $indice), $pos_ovi );
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), $pos_bovino );
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(28, $indice), $pos_rivanol );

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(29, $indice), $total_pos);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(30, $indice), $total_neg);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(31, $indice), '=SUM(AC'.($indice).'+AD'.($indice).'+Y'.($indice).')');
        //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $info_are[0]['fecha']);

        $objPHPExcel->getActiveSheet()->insertNewRowBefore($indice+1, 1);
        $indice++;

    }
    /*
     *
     * Fin ciclo por número de casos agrupados por caso y laboratorio
     *
     * */


    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "Informe_" .date('d-m-Y');
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');
}
/*
 *
 * Fin Reporte de laboratorio - informe
 *
 * */

if($tipo==10) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $medico = Yii::$app->request->get("med");
    $valido = 0;

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/Dictamenes con fecha vencida.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');

    $med = \app\models\Medicos::findOne($medico);
    $nombre_med = $med->c05_nombre;
    if($med->c05_apaterno)
        $nombre_med .= ' '. $med->c05_apaterno;
    if($med->c05_amaterno)
        $nombre_med .= ' '. $med->c05_amaterno;
    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, 1), "DICTAMEN(ES) PENDIENTE(S) DE: ".$nombre_med);

    //Consulta para dictamenes de TB
    $cons = \app\models\Tuberculosis::findBySql("
    SELECT * 
    FROM r16_folios_medicos r16 
    JOIN p03_tb p03 ON r16.p03_id=p03.p03_id 
    WHERE r16.c05_id=".$medico." AND TIMESTAMPDIFF(day, r16_fecha_folio,CURDATE())>29 AND r16_estatus=1 AND r16.r16_entregado=0 AND r16_tipo_dictamen=1 AND r16.p03_id IN (SELECT p03.p03_id FROM p03_tb p03 WHERE p03.p03_id=r16.p03_id);
    ")->all();

    $estilo = $objPHPExcel->getActiveSheet()->getStyle('B4');
    $indice = 3;
    foreach ($cons as $tb) {
        $valido = 1;
        $upp = \app\models\Upp::findOne($tb->r01_id);
        $productor = \app\models\Ganaderos::findOne($tb->c01_id);
        $nombre_prod = $productor->c01_nombre;
        if($productor->c01_apaterno)
            $nombre_prod .= ' '.$productor->c01_apaterno;
        if($productor->c01_amaterno)
            $nombre_prod .= ' '.$productor->c01_amaterno;
        $tipo_prueba = \app\models\TipoPrueba::findOne($tb->p03_tipoPrueba);
        $motivo = \app\models\MotivoPrueba::findOne($tb->p03_motivoPrueba);
        $zoo = \app\models\FuncionesZoo::findOne($tb->p03_funcZoo);
        $folios = \app\models\FoliosMedicos::find()->where(" p03_id=:id AND r16_estatus=1 AND r16_tipo_dictamen=1 LIMIT 1", [':id'=>$tb->p03_id])->one();
        $user =\app\models\PerfilUsuario::findOne($folios->r16_usuAlta);
        $usuario = $user->a02_nombre;
        if($user->a02_apaterno)
            $usuario .= ' '.$user->a02_apaterno;
        if($user->a02_amaterno)
            $usuario .= ' '.$user->a02_amaterno;

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), "TUBERCULOSIS");
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $tb->p03_folio);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $upp->r01_clave);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $upp->r01_nombre);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $nombre_prod);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $tipo_prueba->c08_descripcion);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $motivo->c07_descripcion);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $zoo->c09_descrip);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $folios->r16_fecha_folio);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $usuario);
        $indice++;
    }

    //Consulta para dictamenes de BR
    $cons = \app\models\Tuberculosis::findBySql("
    SELECT * 
    FROM r16_folios_medicos r16 
    JOIN p03_br p03 ON r16.p03_id=p03.p03_id 
    WHERE r16.c05_id=".$medico." AND TIMESTAMPDIFF(day, r16_fecha_folio,CURDATE())>29 AND r16_estatus=1 AND r16.r16_entregado=0 AND r16_tipo_dictamen=2  AND r16.p03_id IN (SELECT p03.p03_id FROM p03_tb p03 WHERE p03.p03_id=r16.p03_id);
    ")->all();

    foreach ($cons as $br) {
        $valido = 1;
        $upp = \app\models\Upp::findOne($br->r01_id);
        $productor = \app\models\Ganaderos::findOne($br->c01_id);
        $nombre_prod = $productor->c01_nombre;
        if($productor->c01_apaterno)
            $nombre_prod .= ' '.$productor->c01_apaterno;
        if($productor->c01_amaterno)
            $nombre_prod .= ' '.$productor->c01_amaterno;
        $tipo_prueba = \app\models\TipoPrueba::findOne($br->p03_tipoPrueba);
        $motivo = \app\models\MotivoPrueba::findOne($br->p03_motivoPrueba);
        $zoo = \app\models\FuncionesZoo::findOne($br->p03_funcZoo);
        $folios = \app\models\FoliosMedicos::find()->where(" p03_id=:id AND r16_estatus=1 AND r16_tipo_dictamen=2 LIMIT 1", [':id'=>$br->p03_id])->one();
        $user =\app\models\PerfilUsuario::findOne($folios->r16_usuAlta);
        $usuario = $user->a02_nombre;
        if($user->a02_apaterno)
            $usuario .= ' '.$user->a02_apaterno;
        if($user->a02_amaterno)
            $usuario .= ' '.$user->a02_amaterno;

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), "BRUCELOSIS");
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $br->p03_folio);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $upp->r01_clave);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $upp->r01_nombre);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $nombre_prod);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $tipo_prueba->c08_descripcion);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $motivo->c07_descripcion);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $zoo->c09_descrip);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $folios->r16_fecha_folio);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $usuario);
        $indice++;
    }

    //Consulta para dictamenes de VC
    $cons = \app\models\Vacunacion::findBySql("
    SELECT * 
    FROM r16_folios_medicos r16 
    JOIN p03_vc p03 ON r16.p03_id=p03.p03_id 
    WHERE r16.c05_id=".$medico." AND TIMESTAMPDIFF(day, r16_fecha_folio,CURDATE())>29 AND r16_estatus=1 AND r16.r16_entregado=0 AND r16_tipo_dictamen=3  AND r16.p03_id IN (SELECT p03.p03_id FROM p03_tb p03 WHERE p03.p03_id=r16.p03_id);
    ")->all();

    foreach ($cons as $vc) {
        $valido = 1;
        $upp = \app\models\Upp::findOne($vc->r01_id);
        $productor = \app\models\Ganaderos::findOne($vc->c01_id);
        $nombre_prod = $productor->c01_nombre;
        if($productor->c01_apaterno)
            $nombre_prod .= ' '.$productor->c01_apaterno;
        if($productor->c01_amaterno)
            $nombre_prod .= ' '.$productor->c01_amaterno;
        $tipo_prueba = \app\models\TipoPrueba::findOne($vc->p03_tipoPrueba);
        $folios = \app\models\FoliosMedicos::find()->where(" p03_id=:id AND r16_estatus=1 AND r16_tipo_dictamen=3 LIMIT 1", [':id'=>$vc->p03_id])->one();
        $user =\app\models\PerfilUsuario::findOne($folios->r16_usuAlta);
        $usuario = $user->a02_nombre;
        if($user->a02_apaterno)
            $usuario .= ' '.$user->a02_apaterno;
        if($user->a02_amaterno)
            $usuario .= ' '.$user->a02_amaterno;

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), "VACUNACIÓN");
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $vc->p03_folio);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $upp->r01_clave);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $upp->r01_nombre);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $nombre_prod);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $tipo_prueba->c08_descripcion);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), "");
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), "");
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $folios->r16_fecha_folio);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $usuario);
        $indice++;
    }
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "Dictamenes con fecha vencida - ".$nombre_med;
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";

    if($valido == 1)
        $this->registerJs($script, View::POS_LOAD, 'descargarReporte');
    else
        echo "<script> alert('No se encontraron resultados'); </script>";

}

/*
 *
 * Inicio reporte laboratorio - SIVE
 *
 * */
if($tipo==11) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $desde_lab = Yii::$app->request->get("desde");
    $hasta_lab = Yii::$app->request->get("hasta");

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/SIVE.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');

    $dicts = \app\models\Brucelosis::findBySql(
        "
SELECT 
* 
FROM p03_br
WHERE p03_isdictaminado AND p03_nocaso AND p03_frecepcion BETWEEN '".$desde_lab."' AND '".$hasta_lab."'
GROUP BY p03_nocaso, p03_laboratorio
ORDER BY p03_nocaso")->all();

    $indice = 2;
    foreach ($dicts as $d) {
        $info_dic = Yii::$app->db->createCommand("
SELECT 
p03_nocaso AS caso, 
(SELECT a02_nombre FROM a02_usudatos WHERE a02_islab=1 AND a02_id=p03_laboratorio) AS laboratorio,
(SELECT c02_nom_ent FROM c02_estados WHERE c02_cve_ent=r01.r01_estado) AS estado,
(SELECT c03_nom_mun FROM c03_municipios WHERE c03_id=r01.r01_municipio) AS municipio,
(SELECT IF(r02_especie=1, 'BOVINO', IF(r02_especie=2, 'CAPRINO', 'OVINO')) FROM r02_aretes WHERE r02_id=(SELECT r02_id FROM r07_brucelosis_aretes WHERE p03_br=p03.p03_id LIMIT 1) LIMIT 1) AS especie,
'' AS enfermedad,
SUM((SELECT IF(p03_totalHato IS NOT NULL,p03_totalHato,IF(p03_tipoPrueba=3 || p03_tipoPrueba=4, (select COUNT(a.r07_id) from r07_brucelosis_aretes a WHERE a.p03_br=p03.p03_dictamenAnt), (select COUNT(b.r07_id) from r07_brucelosis_aretes b WHERE b.p03_br=p03.p03_id)) ) ) ) AS total,
'' AS enfermos,
'' AS muertos,
'SUERO SANGUÍNEO' AS tipodemuestra,
SUM((SELECT COUNT(*) FROM r07_brucelosis_aretes WHERE p03_br=p03.p03_id AND r07_resultado!=17)) AS enviadas,
(SELECT if(c08_id=2, 'T', if(c08_id=3, 'RIV', 'FC') ) FROM c08_tipo_prueba WHERE c08_id=p03.p03_tipoPrueba) AS tecnicadiagnostica,
DATE_FORMAT(p03.p03_fmuestreo, \"%Y-%m-%d\") AS fecha_muestreo,
DATE_FORMAT(p03.p03_frecepcion, \"%Y-%m-%d\") AS fecha_recepcion,
DATE_FORMAT(p03.p03_fecha, \"%Y-%m-%d\") AS fecha_resultado,
r01_latitud AS latitud,
r01_longitud AS longitud,
(SELECT CONCAT(IFNULL(c01_nombre, ''), ' ', IFNULL(c01_apaterno, ''), ' ', IFNULL(c01_amaterno, '')) FROM c01_ganaderos c01 WHERE c01.c01_id=p03.c01_id) AS propietario,
r01_nombre AS nombre_upp,
(SELECT c09_descrip FROM c09_funcion_zoo WHERE c09_id=p03.p03_funcZoo) AS funcion_zoo
FROM p03_br p03
INNER JOIN r01_upp r01 ON r01.r01_id=p03.r01_id 
WHERE p03.p03_nocaso=$d->p03_nocaso AND p03.p03_laboratorio=$d->p03_laboratorio AND p03_frecepcion BETWEEN '".$desde_lab."' AND '".$hasta_lab."'
",[])->queryAll();

        $totales = Yii::$app->db->createCommand("
SELECT 
CAST( COUNT(IF( IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=1 || IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=8,1,NULL) ) AS UNSIGNED) AS negativas,
CAST( COUNT(IF( IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=2 || IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=9 || IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=10 || IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=11 || IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=26 || IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=27 || IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=28 || IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=29 ,1,NULL) ) AS UNSIGNED) AS positivas,
CAST( COUNT(IF( IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=3 || IFNULL((SELECT r07_rivanol FROM p03_br riv WHERE riv.p03_dictamenant=tar.p03_id), r07_resultado)=17,1,NULL) ) AS UNSIGNED) AS notrabajadas
FROM r07_brucelosis_aretes r07 
INNER JOIN p03_br tar ON r07.p03_br=tar.p03_id
WHERE  tar.p03_nocaso=$d->p03_nocaso AND tar.p03_laboratorio=$d->p03_laboratorio AND tar.p03_frecepcion BETWEEN '".$desde_lab."' AND '".$hasta_lab."' AND r07.r07_resultado!=17
",[])->queryAll();

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $info_dic[0]['caso']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), 'LDV ' . substr($info_dic[0]['laboratorio'], 43, strlen($info_dic[0]['laboratorio'])) );
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $info_dic[0]['estado']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $info_dic[0]['municipio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $info_dic[0]['especie']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $info_dic[0]['enfermedad']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $info_dic[0]['total']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $info_dic[0]['enfermos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $info_dic[0]['muertos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $info_dic[0]['tipodemuestra']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $info_dic[0]['enviadas']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $totales[0]['positivas']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $totales[0]['negativas']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), 0);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $totales[0]['notrabajadas']);

        //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $info_dic[0]['observaciones']);
        //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $info_dic[0]['tipificacion']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $info_dic[0]['tecnicadiagnostica']);

        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $info_dic[0]['fecha_muestreo']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $info_dic[0]['fecha_recepcion']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), $info_dic[0]['fecha_resultado']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $info_dic[0]['latitud']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $info_dic[0]['longitud']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $info_dic[0]['propietario']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $info_dic[0]['nombre_upp']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(26, $indice), $info_dic[0]['funcion_zoo']);
        //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $info_are[0]['fecha']);

        $objPHPExcel->getActiveSheet()->insertNewRowBefore($indice+1, 1);
        $indice++;
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "SIVE_" .date('d-m-Y');
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');
}
/*
 *
 * Fin reporte laboratorio - SIVE
 *
 * */

if($tipo==12) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/CapturaEngorda.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');
    $aretes = Yii::$app->db->createCommand("
SELECT 
a.r02_numero AS arete, 
a.r02_especie AS especie, 
b.r02_edad AS edad, 
IF(b.r02_raza2, CONCAT((select c06_clave from c06_raza where c06_id=b.r02_raza), '/', (select c06_clave from c06_raza where c06_id=b.r02_raza2)), (select c06_clave from c06_raza where c06_id=b.r02_raza)) AS raza,
IF(b.r02_sexo,'H', 'M') AS sexo,
b.r02_corral AS corral,
sl01_tipo AS tipo_captura,
sl01_id AS id_captura
FROM sl02_capturas_aretes a 
JOIN r02_aretes b ON a.r02_numero=b.r02_numero AND a.r02_especie=b.r02_especie 
GROUP BY b.r02_numero, b.r02_especie, sl01_tipo")->queryAll();

    $indice = 2;
    for($i=0; $i<sizeof($aretes); $i++){
        //$aretes[] = $i;
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $aretes[$i]['arete']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $aretes[$i]['edad']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $aretes[$i]['raza']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $aretes[$i]['sexo']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $aretes[$i]['corral']);
        if($aretes[$i]['tipo_captura']==1){
            $entrada = \app\models\CapturasEntrada::find()
                ->where('sl01_activo=1')
                ->andWhere('sl01_id=:id',[':id'=>$aretes[$i]['id_captura']])
                ->one();
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $entrada->sl01_entFolioPermiso);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $entrada->sl01_entFechaIngreso);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $entrada->sl01_entJaula);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $entrada->sl01_entCertZoo);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $entrada->sl01_entFolioTb);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $entrada->sl01_entFolioBr);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $entrada->sl01_entGuia);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $entrada->sl01_entFleje);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $entrada->sl01_entObservaciones);

            if($i+1<sizeof($aretes)){
                if($aretes[$i+1]['tipo_captura']==1 && $aretes[$i]['arete']==$aretes[$i+1]['arete'] && $aretes[$i]['especie']==$aretes[$i+1]['especie']){
                    $i++;
                }else if($aretes[$i+1]['tipo_captura']==2 && $aretes[$i]['arete']==$aretes[$i+1]['arete'] && $aretes[$i]['especie']==$aretes[$i+1]['especie']){
                    $salida = \app\models\CapturasSalida::find()
                        ->where('sl01_activo=1')
                        ->andWhere('sl01_id=:id',[':id'=>$aretes[$i+1]['id_captura']])
                        ->one();
                    $estado = \app\models\Estados::findOne($salida->sl01_salEstado);
                    $municipio = \app\models\Municipios::findOne($salida->sl01_salMunicipio);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $salida->sl01_salFechaSalida);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $salida->sl01_salGuia);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $salida->sl01_salCertZoo);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $salida->sl01_salFolioTb);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $salida->sl01_salFolioGarr);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $salida->sl01_salFleje);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), '');

                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $salida->sl01_salDomicilio);
                    if($municipio)
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $municipio->c03_nom_mun);
                    if($estado)
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $estado->c02_nom_ent);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $salida->sl01_salDestino);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), $salida->sl01_salObservaciones);
                    $i++;
                }

            }
        }else{
            $salida = \app\models\CapturasSalida::find()
                ->where('sl01_activo=1')
                ->andWhere('sl01_id=:id',[':id'=>$aretes[$i]['id_captura']])
                ->one();
            $estado = \app\models\Estados::findOne($salida->sl01_salEstado);
            $municipio = \app\models\Municipios::findOne($salida->sl01_salMunicipio);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $salida->sl01_salFechaSalida);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $salida->sl01_salGuia);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $salida->sl01_salCertZoo);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $salida->sl01_salFolioTb);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $salida->sl01_salFolioGarr);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $salida->sl01_salFleje);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), '');

            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $salida->sl01_salDomicilio);
            if($municipio)
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $municipio->c03_nom_mun);
            if($estado)
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $estado->c02_nom_ent);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $salida->sl01_salDestino);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), $salida->sl01_salObservaciones);
        }
        $indice++;
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "CapturaEngorda_" .date('d-m-Y');
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');
}

if($tipo==13) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $desde = Yii::$app->request->get("desde");
    $hasta = Yii::$app->request->get("hasta");

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/CapturaEngorda.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');
    $aretes = Yii::$app->db->createCommand("
SELECT 
a.r02_numero AS arete, 
a.r02_especie AS especie, 
b.r02_edad AS edad, 
IF(b.r02_raza2, CONCAT((select c06_clave from c06_raza where c06_id=b.r02_raza), '/', (select c06_clave from c06_raza where c06_id=b.r02_raza2)), (select c06_clave from c06_raza where c06_id=b.r02_raza)) AS raza,
IF(b.r02_sexo,'H', 'M') AS sexo,
b.r02_corral AS corral,
sl01_tipo AS tipo_captura,
sl01_id AS id_captura
FROM sl02_capturas_aretes a 
JOIN r02_aretes b ON a.r02_numero=b.r02_numero AND a.r02_especie=b.r02_especie 
GROUP BY b.r02_numero, b.r02_especie, sl01_tipo")->queryAll();

    $indice = 2;
    for($i=0; $i<sizeof($aretes); $i++){

        if($aretes[$i]['tipo_captura']==1){
            $entrada = \app\models\CapturasEntrada::findBySql("
            SELECT 
            *
            FROM sl01_capturas_entrada a
            WHERE sl01_activo=1 AND sl01_id=:id AND sl01_entFechaIngreso 
            BETWEEN '".$desde."' AND '".$hasta."'
            ", [':id'=>$aretes[$i]['id_captura']] )->one();
            /*$entrada = \app\models\CapturasEntrada::find()
                ->where('sl01_activo=1')
                ->andWhere('sl01_id=:id',[':id'=>$aretes[$i]['id_captura']])
                ->one();*/
            /*foreach ($entrada as $e){
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $e->sl01_entFolioPermiso);
            }*/
            if($entrada){
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $aretes[$i]['arete']);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $aretes[$i]['edad']);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $aretes[$i]['raza']);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $aretes[$i]['sexo']);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $aretes[$i]['corral']);

                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $entrada->sl01_entFolioPermiso);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $entrada->sl01_entFechaIngreso);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $entrada->sl01_entJaula);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $entrada->sl01_entCertZoo);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $entrada->sl01_entFolioTb);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $entrada->sl01_entFolioBr);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $entrada->sl01_entGuia);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $entrada->sl01_entFleje);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $entrada->sl01_entObservaciones);

                if($i+1<sizeof($aretes)){
                    if($aretes[$i+1]['tipo_captura']==1 && $aretes[$i]['arete']==$aretes[$i+1]['arete'] && $aretes[$i]['especie']==$aretes[$i+1]['especie']){
                        $i++;
                    }else if($aretes[$i+1]['tipo_captura']==2 && $aretes[$i]['arete']==$aretes[$i+1]['arete'] && $aretes[$i]['especie']==$aretes[$i+1]['especie']){
                        $salida = \app\models\CapturasSalida::find()
                            ->where('sl01_activo=1')
                            ->andWhere('sl01_id=:id',[':id'=>$aretes[$i+1]['id_captura']])
                            ->one();
                        $estado = \app\models\Estados::findOne($salida->sl01_salEstado);
                        $municipio = \app\models\Municipios::findOne($salida->sl01_salMunicipio);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $salida->sl01_salFechaSalida);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $salida->sl01_salGuia);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $salida->sl01_salCertZoo);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $salida->sl01_salFolioTb);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $salida->sl01_salFolioGarr);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $salida->sl01_salFleje);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), '');

                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $salida->sl01_salDomicilio);
                        if($municipio)
                            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $municipio->c03_nom_mun);
                        if($estado)
                            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $estado->c02_nom_ent);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $salida->sl01_salDestino);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), $salida->sl01_salObservaciones);
                        $i++;
                    }

                }
                $indice++;
            }

        }

    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "CapturaEngorda_" .date('d-m-Y');
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');
}

if($tipo==14) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $desde = Yii::$app->request->get("desde");
    $hasta = Yii::$app->request->get("hasta");

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/CapturaEngorda.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');
    $aretes = Yii::$app->db->createCommand("
SELECT 
a.r02_numero AS arete, 
a.r02_especie AS especie, 
b.r02_edad AS edad, 
IF(b.r02_raza2, CONCAT((select c06_clave from c06_raza where c06_id=b.r02_raza), '/', (select c06_clave from c06_raza where c06_id=b.r02_raza2)), (select c06_clave from c06_raza where c06_id=b.r02_raza)) AS raza,
IF(b.r02_sexo,'H', 'M') AS sexo,
b.r02_corral AS corral,
sl01_tipo AS tipo_captura,
sl01_id AS id_captura
FROM sl02_capturas_aretes a 
JOIN r02_aretes b ON a.r02_numero=b.r02_numero AND a.r02_especie=b.r02_especie 
GROUP BY b.r02_numero, b.r02_especie, sl01_tipo")->queryAll();

    $indice = 2;
    for($i=0; $i<sizeof($aretes); $i++){

        if($aretes[$i]['tipo_captura']==2){
            $salida = \app\models\CapturasSalida::findBySql("
            SELECT 
            *
            FROM sl01_capturas_salida
            WHERE sl01_activo=1 AND sl01_id=:id AND sl01_salFechaSalida 
            BETWEEN '".$desde."' AND '".$hasta."'
            ", [':id'=>$aretes[$i]['id_captura']] )->one();
            if($salida){
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $aretes[$i]['arete']);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $aretes[$i]['edad']);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $aretes[$i]['raza']);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $aretes[$i]['sexo']);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $aretes[$i]['corral']);

                $estado = \app\models\Estados::findOne($salida->sl01_salEstado);
                $municipio = \app\models\Municipios::findOne($salida->sl01_salMunicipio);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $salida->sl01_salFechaSalida);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $salida->sl01_salGuia);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $salida->sl01_salCertZoo);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $salida->sl01_salFolioTb);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $salida->sl01_salFolioGarr);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $salida->sl01_salFleje);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), '');

                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $salida->sl01_salDomicilio);
                if($municipio)
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $municipio->c03_nom_mun);
                if($estado)
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $estado->c02_nom_ent);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $salida->sl01_salDestino);
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), $salida->sl01_salObservaciones);

                if($i+1>0){
                    if($aretes[$i-1]['tipo_captura']==2 && $aretes[$i]['arete']==$aretes[$i-1]['arete'] && $aretes[$i]['especie']==$aretes[$i-1]['especie']){
                        $i++;
                    }else if($aretes[$i-1]['tipo_captura']==1 && $aretes[$i]['arete']==$aretes[$i-1]['arete'] && $aretes[$i]['especie']==$aretes[$i-1]['especie']){
                        $entrada = \app\models\CapturasEntrada::find()
                            ->where('sl01_activo=1')
                            ->andWhere('sl01_id=:id',[':id'=>$aretes[$i-1]['id_captura']])
                            ->one();
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $entrada->sl01_entFolioPermiso);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $entrada->sl01_entFechaIngreso);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $entrada->sl01_entJaula);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $entrada->sl01_entCertZoo);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $entrada->sl01_entFolioTb);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $entrada->sl01_entFolioBr);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $entrada->sl01_entGuia);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $entrada->sl01_entFleje);
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $entrada->sl01_entObservaciones);
                        //$i++;
                    }

                }
                $indice++;
            }

        }

    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "CapturaEngorda_" .date('d-m-Y');
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');
}

if($tipo==15) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $corral = Yii::$app->request->get("co");

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/CapturaEngorda.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');
    $aretes = Yii::$app->db->createCommand("
SELECT 
a.r02_numero AS arete, 
a.r02_especie AS especie, 
b.r02_edad AS edad, 
IF(b.r02_raza2, CONCAT((select c06_clave from c06_raza where c06_id=b.r02_raza), '/', (select c06_clave from c06_raza where c06_id=b.r02_raza2)), (select c06_clave from c06_raza where c06_id=b.r02_raza)) AS raza,
IF(b.r02_sexo,'H', 'M') AS sexo,
b.r02_corral AS corral,
sl01_tipo AS tipo_captura,
sl01_id AS id_captura
FROM sl02_capturas_aretes a 
JOIN r02_aretes b ON a.r02_numero=b.r02_numero AND a.r02_especie=b.r02_especie
WHERE b.r02_corral='".$corral."' 
GROUP BY b.r02_numero, b.r02_especie, sl01_tipo")->queryAll();

    $indice = 2;
    for($i=0; $i<sizeof($aretes); $i++){
        //$aretes[] = $i;
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $aretes[$i]['arete']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(2, $indice), $aretes[$i]['edad']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $aretes[$i]['raza']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(4, $indice), $aretes[$i]['sexo']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $aretes[$i]['corral']);
        if($aretes[$i]['tipo_captura']==1){
            $entrada = \app\models\CapturasEntrada::find()
                ->where('sl01_activo=1')
                ->andWhere('sl01_id=:id',[':id'=>$aretes[$i]['id_captura']])
                ->one();
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $entrada->sl01_entFolioPermiso);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $entrada->sl01_entFechaIngreso);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $entrada->sl01_entJaula);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(8, $indice), $entrada->sl01_entCertZoo);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $entrada->sl01_entFolioTb);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $entrada->sl01_entFolioBr);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $entrada->sl01_entGuia);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $entrada->sl01_entFleje);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $entrada->sl01_entObservaciones);

            if($i+1<sizeof($aretes)){
                if($aretes[$i+1]['tipo_captura']==1 && $aretes[$i]['arete']==$aretes[$i+1]['arete'] && $aretes[$i]['especie']==$aretes[$i+1]['especie']){
                    $i++;
                }else if($aretes[$i+1]['tipo_captura']==2 && $aretes[$i]['arete']==$aretes[$i+1]['arete'] && $aretes[$i]['especie']==$aretes[$i+1]['especie']){
                    $salida = \app\models\CapturasSalida::find()
                        ->where('sl01_activo=1')
                        ->andWhere('sl01_id=:id',[':id'=>$aretes[$i+1]['id_captura']])
                        ->one();
                    $estado = \app\models\Estados::findOne($salida->sl01_salEstado);
                    $municipio = \app\models\Municipios::findOne($salida->sl01_salMunicipio);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $salida->sl01_salFechaSalida);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $salida->sl01_salGuia);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $salida->sl01_salCertZoo);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $salida->sl01_salFolioTb);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $salida->sl01_salFolioGarr);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $salida->sl01_salFleje);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), '');

                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $salida->sl01_salDomicilio);
                    if($municipio)
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $municipio->c03_nom_mun);
                    if($estado)
                        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $estado->c02_nom_ent);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $salida->sl01_salDestino);
                    $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), $salida->sl01_salObservaciones);
                    $i++;
                }

            }
        }else{
            $salida = \app\models\CapturasSalida::find()
                ->where('sl01_activo=1')
                ->andWhere('sl01_id=:id',[':id'=>$aretes[$i]['id_captura']])
                ->one();
            $estado = \app\models\Estados::findOne($salida->sl01_salEstado);
            $municipio = \app\models\Municipios::findOne($salida->sl01_salMunicipio);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $salida->sl01_salFechaSalida);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $salida->sl01_salGuia);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $salida->sl01_salCertZoo);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $salida->sl01_salFolioTb);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $salida->sl01_salFolioGarr);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $salida->sl01_salFleje);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), '');

            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $salida->sl01_salDomicilio);
            if($municipio)
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $municipio->c03_nom_mun);
            if($estado)
                $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $estado->c02_nom_ent);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $salida->sl01_salDestino);
            $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(27, $indice), $salida->sl01_salObservaciones);
        }
        $indice++;
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "CapturaEngorda_" .date('d-m-Y');
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');
}

//Reporte Control folios
//Entrega Documentación Vacunación
if($tipo==16) {
    require_once Yii::$app->getBasePath().'/web/php/PHPExcel.php';

    $filtro = Yii::$app->request->get("filtro");
    $desde = Yii::$app->request->get("desde");
    $hasta = Yii::$app->request->get("hasta");

    //$arete_traza = 3529281;

    $objPHPExcel = new PHPExcel();
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objPHPExcel = $objReader->load(Yii::$app->getBasePath() . '/web/plantillas/Documentacion VC.xlsx');
    $objPHPExcel->setActiveSheetIndex(0);

    setlocale(LC_CTYPE, 'de_DE.UTF8');

    if($filtro==0) {//con folios
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            *
            FROM p03_vc p03
            WHERE  p03.p03_fexpedicion BETWEEN '" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio")->all();
    }else if($filtro==1) {//entregados
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            * 
            FROM p03_vc p03 
            JOIN r16_folios_medicos r16 ON r16.p03_id=p03.p03_id AND r16.r16_tipo_dictamen=3 AND r16.r16_estatus=1
            WHERE r16.r16_entregado=1 AND p03.p03_fexpedicion BETWEEN'" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio")->all();
    }else if($filtro==2) {//pendientes de entrega
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            * 
            FROM p03_vc p03 
            JOIN r16_folios_medicos r16 ON r16.p03_id=p03.p03_id AND r16.r16_tipo_dictamen=3 AND r16.r16_estatus=1
            WHERE r16.r16_entregado=0 AND p03.p03_fexpedicion BETWEEN'" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio")->all();
    }else if($filtro==3) {//sin folio
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            *
            FROM p03_vc p03
            WHERE  p03.p03_fexpedicion BETWEEN '" . $desde . "' AND '" . $hasta . "' AND p03.p03_folio is null")->all();
    }
    else if($filtro==4) {//dictamenes fecha vencida
        $cons = \app\models\Tuberculosis::findBySql("
            SELECT 
            *
            FROM p03_vc p03 
            JOIN r16_folios_medicos r16 ON r16.p03_id=p03.p03_id AND r16.r16_tipo_dictamen=3 AND r16.r16_estatus=1 AND r16.r16_fecha_folio
            WHERE TIMESTAMPDIFF(day, r16_fecha_folio,CURDATE()) >29 AND r16.r16_entregado=0")->all();
    }
    $estilo = $objPHPExcel->getActiveSheet()->getStyle('B4');
    $indice = 11;
    foreach ($cons as $p03) {
        //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, 2), "ARETE: " . $arete);
        $info_tb = Yii::$app->db->createCommand("
SELECT 
p03.p03_folio AS folio,
(select DATE_FORMAT(r16_fecha_folio, \"%d/%m/%Y\") from r16_folios_medicos r16 where r16_tipo_dictamen=3 and r16.p03_id=p03.p03_id and r16_estatus=1 LIMIT 1) AS fecha_entrega,
(select CONCAT(c05_nombre, ' ', c05_apaterno, ' ', c05_amaterno) from c05_mvz where c05_id=p03.c05_id) AS nombre_mvz,
(select c05_clave from c05_mvz where c05_id=p03.c05_id) AS clave_mvz,
(SELECT IF(p03_cepa IS NOT NULL, 'CEPA 19', IF(p03_rb IS NOT NULL, 'RB51', 'REV 1') ) FROM p03_vc WHERE p03_id=p03.p03_id) AS cepa,
(SELECT IF(p03_lote_clasica, p03_lote_clasica, IF(p03_lote_reducida, p03_lote_reducida, IF(p03_lote_becerra, p03_lote_becerra, p03_lote_vaca) ) ) FROM p03_vc WHERE p03_id=p03.p03_id) AS lote,
(SELECT DATE_FORMAT( IF(p03_cad_clasica, p03_cad_clasica, IF(p03_cad_reducida, p03_cad_reducida, IF(p03_cad_becerra, p03_cad_becerra, p03_cad_vaca) ) ) , \"%d/%m/%Y\") FROM p03_vc WHERE p03_id=p03.p03_id) AS caducidad,
DATE_FORMAT(p03_fexpedicion, \"%d/%m/%Y\") AS fecha_expedicion,
(select c15_descripcion from c15_zonas WHERE c15_id=r01.r01_zona) AS zona,
(SELECT IF(r02_especie=1, 'BOVINOS', IF(r02_especie=2, 'CAPRINOS', 'OVINOS')) FROM r02_aretes WHERE r02_id=(SELECT r02_id FROM r05_seleccion_previa_aretes WHERE p02_id=(SELECT p02_id FROM p02_seleccion_previa WHERE r03_dictamen_vc=p03.p03_id) LIMIT 1) ) AS especie,
(select CONCAT(c01_nombre, ' ', c01_apaterno, ' ', c01_amaterno) from c01_ganaderos WHERE c01_id=p03.c01_id) AS productor,
CONCAT(r01.r01_calle, ' ', r01.r01_colonia) AS domicilio,
r01.r01_nombre AS predio,
(SELECT c04_nom_loc FROM c04_localidades_zac WHERE c04_id=r01.r01_localidad) AS poblacion,
r01.r01_clave AS upp,
(SELECT c03_nom_mun FROM c03_municipios WHERE c03_id=r01.r01_municipio) AS municipio,
(SELECT COUNT(r02_id) FROM r05_seleccion_previa_aretes WHERE p02_id=(SELECT p02_id FROM p02_seleccion_previa WHERE r03_dictamen_vc=p03.p03_id) AND r05_vc ) AS cabezas,
(SELECT COUNT(*) FROM r05_seleccion_previa_aretes r05 WHERE p02_id=(SELECT p02_id FROM p02_seleccion_previa WHERE r03_dictamen_vc=p03.p03_id) AND r05_vc AND if((SELECT r02_especie FROM r02_aretes WHERE r02_id=r05.r02_id LIMIT 1)=1 , r05.r02_edad>12, r05.r02_edad>4) ) AS adultos,
(SELECT COUNT(*) FROM r05_seleccion_previa_aretes r05 WHERE p02_id=(SELECT p02_id FROM p02_seleccion_previa WHERE r03_dictamen_vc=p03.p03_id) AND r05_vc AND if((SELECT r02_especie FROM r02_aretes WHERE r02_id=r05.r02_id LIMIT 1)=1 , r05.r02_edad<=12, r05.r02_edad<=4) ) AS jovenes,
if(r01.r01_latitud,r01.r01_latitud,'') AS latitud,
if(r01.r01_longitud, r01.r01_longitud, '') AS longitud,
(select if(r16_entregado=1,'Sí','No') from r16_folios_medicos r16 where r16_tipo_dictamen=3 and r16.p03_id=p03.p03_id and r16_estatus=1 LIMIT 1) AS recibido,
(select DATE_FORMAT(r16_fecha_entregado, \"%d/%m/%Y\") from r16_folios_medicos r16 where r16_tipo_dictamen=3 and r16.p03_id=p03.p03_id and r16_estatus=1 LIMIT 1) AS fecha_recibido
FROM p03_vc p03 
INNER JOIN r01_upp r01 ON p03.r01_id=r01.r01_id
WHERE p03.p03_id=$p03->p03_id;
",[])->queryAll();
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(1, $indice), $indice-10);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(3, $indice), $info_tb[0]['folio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(5, $indice), $info_tb[0]['fecha_entrega']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(6, $indice), $info_tb[0]['nombre_mvz']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(7, $indice), $info_tb[0]['clave_mvz']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(9, $indice), $info_tb[0]['cepa']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(10, $indice), $info_tb[0]['lote']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(11, $indice), $info_tb[0]['caducidad']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(12, $indice), $info_tb[0]['fecha_expedicion']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(13, $indice), $info_tb[0]['zona']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(14, $indice), $info_tb[0]['especie']);
        //$objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(15, $indice), $info_tb[0]['zona']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(16, $indice), $info_tb[0]['productor']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(17, $indice), $info_tb[0]['domicilio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(18, $indice), $info_tb[0]['predio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(19, $indice), $info_tb[0]['poblacion']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(20, $indice), $info_tb[0]['upp']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(21, $indice), $info_tb[0]['municipio']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(22, $indice), $info_tb[0]['cabezas']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(23, $indice), $info_tb[0]['adultos']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(24, $indice), $info_tb[0]['jovenes']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(25, $indice), $info_tb[0]['latitud']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(26, $indice), $info_tb[0]['longitud']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(28, $indice), $info_tb[0]['recibido']);
        $objPHPExcel->getActiveSheet()->setCellValue(Utileria::getCelda(29, $indice), $info_tb[0]['fecha_recibido']);
        $indice++;
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $nombre = "DocumentacionVC_" .$desde."_".$hasta;
    $objWriter->save("files/excel/" . $nombre . ".xlsx");
    $script = "
    var a = document.createElement('a');
    a.download = '" . $nombre . "';
    a.href = 'files/excel/" . $nombre . ".xlsx';
    a.click();

    ";
    $this->registerJs($script, View::POS_LOAD, 'descargarReporte');


}
?>
