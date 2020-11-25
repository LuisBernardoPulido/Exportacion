<?php

$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_exportaciones_solicitudes.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_eliminar_aretes.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('css/estilo_exportacion.css');
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SolicitudesExportaciones */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord){
    $editando = -1;
    $visible = false;
    $aretes = \app\models\SolicitudesExportaciones::getAretesNo();

    $bloqueo = false;
}else{
    $unidades_destino = \yii\helpers\Url::to(['upplisterror']);
    $editando = $model->p12_id;
    $visible = true;
    $aretes = \app\models\SolicitudesExportaciones::getAretesSolicitud($editando);

    $bloqueo = true;
}
?>
<div class="panel panel-primary" id="panel-primary">
    <div class="panel-heading" id="panel-heading-mpc">Datos de solicitud de exportación</div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin(); ?>
        <input type="hidden" id="editando" value="<?=$editando?>">
        <div class="row" >
            <div class="col-md-4">
                <?= $form->field($model, 'p12_sexo')->widget(\kartik\widgets\Select2::className(),[
                    'data' => [ '0'=>'MACHOS CASTRADOS', '1'=>'HEMBRAS', '2'=>'AMBOS SEXOS'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]) ?>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-12">
                <div class="panel panel-info" style="display: block">
                    <div class="panel-heading" id="panel-info-header">Tabla de aretes</div>
                    <div class="panel-body">

                        <div class="row" >
                            <div class="col-md-6">
                                <div class="panel panel-info" style="display: block">
                                    <div class="panel-heading" id="panel-info-header">Capturar arete</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Identificador</label><br>
                                                <input class="form-control" maxlength="10" id="cap_are" autocomplete="off"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Ej. 1409600001"  <?php if($bloqueo) echo "readonly";?> autofocus>
                                            </div>
                                            <div class="col-xs-2">
                                                <label class="control-label" for="botonOk">&nbsp;</label>
                                                <button type="button" id="btnAgregar" onclick="agregarArete(<?=$editando?>)" class="btn btn-info btn-flat col-xs-12" style="color: white; border-color: #942626; background-color: #942626";">Agregar</button>
                                            </div>
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Cargar desde archivo</label><br>
                                                </div>
                                            <div class="col-xs-2">
                                                <label class="control-label" for="botonCargar">&nbsp;</label>
                                                <button type="button" id="btnCargar" onclick="cargarArete(<?=$editando?>)" class="btn btn-info btn-flat col-xs-12" style="color: white; border-color: #942626; background-color: #942626";">Cargar</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <?php \yii\widgets\Pjax::begin(['id' => 'tabla_aretes']); ?>
                                <?= \yii\grid\GridView::widget([
                                    'dataProvider' => $aretes,

                                    'columns' => [
                                        [
                                            'class' => 'yii\grid\SerialColumn',
                                            'contentOptions'=>[
                                                "width"=>"3%",
                                            ],
                                        ],

                                        [
                                            'label'=>'Arete',
                                            'contentOptions'=>[
                                                "align"=>"center",
                                                "width"=>"10%",
                                            ],
                                            'value'=>function($info){
                                                return \app\models\ExportacionAretes::findOne($info->r28_id)->r28_numero;
                                            },

                                        ],
                                        [
                                            'label'=>'Estatus',
                                            'contentOptions'=>[
                                                "align"=>"center",
                                                "width"=>"10%",
                                            ],
                                            'value'=>function($info){
                                                if($info->r29_resultado==1){
                                                    return '<i id="yes" class="fa fa-check" aria-hidden="true" style="color: green; font-size: 25px; display: none;"></i>';
                                                }else{
                                                    return '<i id="no" class="fa fa-close" aria-hidden="true" style="color: red; font-size: 25px; display: none;"></i>';
                                                }

                                            },
                                            'format' => 'html'

                                        ],
                                        [
                                            'label'=>'Folio TB',
                                            'contentOptions'=>[
                                                "align"=>"center",
                                                "width"=>"10%",
                                            ],
                                            'value'=>function($info){
                                                return \app\models\ExportacionAretes::findOne($info->r28_id)->r28_tb;
                                            },

                                        ],
                                        [
                                            'label'=>'Folio BR',
                                            'contentOptions'=>[
                                                "align"=>"center",
                                                "width"=>"10%",
                                            ],
                                            'value'=>function($info){
                                                return \app\models\ExportacionAretes::findOne($info->r28_id)->r28_br;
                                            },

                                        ],
                                        [
                                            'label'=>'UPP Origen',
                                            'contentOptions'=>[
                                                "align"=>"center",
                                                "width"=>"10%",
                                            ],
                                            'value'=>function($info){
                                                return \app\models\Upp::findOne(\app\models\Exportacion::findOne(\app\models\ExportacionAretes::findOne($info->r28_id)->p11_id)->r01_origen)->r01_clave;
                                            },

                                        ],
                                        [
                                            'label'=>'Guía de transito',
                                            'contentOptions'=>[
                                                "align"=>"center",
                                                "width"=>"10%",
                                            ],
                                            'value'=>function($info){
                                                return \app\models\Exportacion::findOne(\app\models\ExportacionAretes::findOne($info->r28_id)->p11_id)->p11_guia;
                                            },

                                        ],
                                        [
                                            'attribute' => 'Acción',
                                            'format' => 'raw',
                                            'contentOptions'=>[
                                                "width"=>"6%",
                                            ],
                                            'value' => function($info) {
                                                return Html::a('<span class="glyphicon glyphicon-trash"></span>',false, [
                                                    'class'=>'ajaxDelete',
                                                    'url'=> \yii\helpers\Url::toRoute(['solicitudes-exportaciones/deletearete','id'=>$info->r28_id]),
                                                    'grid'=>'tabla_aretes',
                                                    'param'=>null,
                                                    'title' => Yii::t('yii', 'Delete')]);
                                            }
                                        ],
                                    ],
                                ]); ?>
                                <?php \yii\widgets\Pjax::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2" style="alignment: center;">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <div class="col-md-5"></div>
        </div>

        <?php ActiveForm::end(); ?>



    </div>
</div>

