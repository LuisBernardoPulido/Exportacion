<?php
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\web\View;
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_exportacion.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_eliminar_aretes.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('css/estilo_exportacion.css');

/* @var $this yii\web\View */
/* @var $model app\models\Exportacion */
/* @var $form yii\widgets\ActiveForm */

if($model->isNewRecord){
    //$unidades_destino = \yii\helpers\Url::to(['unidadesdestino', 'prod'=>Yii::$app->user->getId()]);
    $unidades_destino = \yii\helpers\Url::to(['unidadesdestinotemp', 'prod'=>Yii::$app->user->getId()]);
    $editando = -1;
    $visible = false;
    $aretes = \app\models\Exportacion::getAretesNo();

    $bloqueo = false;
}else{
    $unidades_destino = \yii\helpers\Url::to(['upplisterror']);
    $editando = $model->p12_id;
    $visible = true;
    $aretes = \app\models\Exportacion::getAretesSolicitud($editando);

    if($model->p12_estatus_internacion==0)
        $bloqueo = false;
    else
        $bloqueo = true;
}
?>
    <div class="panel panel-primary" id="panel-primary">
        <div class="panel-heading" id="panel-heading-mpc">Datos de ingreso</div>
        <div class="panel-body">
            <div class="internacion-form">
                <?php $form = ActiveForm::begin([
                    'options' => ['enctype'=>'multipart/form-data']
                ]); ?>
                <input type="hidden" id="usuario" value="<?=Yii::$app->user->getId()?>">
                <input type="hidden" id="origen_id_senasica">
                <input type="hidden" id="destino_id_senasica">
                <input type="hidden" id="editando" value="<?=$editando?>">

                <div class="row" >
                    <div class="col-md-12">
                        <div class="panel panel-info" style="display: block">
                            <div class="panel-heading" id="panel-info-header">Unidad de origen</div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <?php
                                            $useri = \app\models\PerfilUsuario::getPerfil(Yii::$app->user->getId());
                                            $user = $useri->a02_nombre;
                                        ?>
                                        <?= $form->field($model, 'p11_usuAlta')->textInput(['maxlength' => true, 'value'=> ''.$user, 'readonly'=> true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <?= $form->field($model, 'r01_origen')->widget(\kartik\widgets\Select2::className(),[
                                                'options' => ['placeholder' => 'Seleccionar una unidad de producción...', 'onchange'=>'unidadOrigen()', 'id'=>'id_origen', 'disabled'=>$bloqueo],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ]) ?>

                                            <label >&nbsp</label>
                                            <span class="input-group-btn">
                                                <button type="button" onclick="abrirUnidades()" class="btn btn-info btn-flat col-xs-12" style="color: white; border-color: #942626; background-color: #942626";">Agregar Unidad</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Hato libre</label>
                                                <br>
                                                <input class="form-control"  id="origen_hl" style="margin-left: 2px; 2px; text-align:left" <?php if($bloqueo) echo "readonly";?> >
                                            </div>
                                            <div class="col-md-3">
                                                <label>Cuarentena</label>
                                                <br>
                                                <input class="form-control"  id="origen_estatus" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                            <!--<div class="col-md-1">
                                                <label>Zona</label>
                                                <br>
                                                <input class="form-control"  id="origen_zona" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Estatus SENASICA</label>
                                                <br>
                                                <input class="form-control"  id="origen_senasica" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Estatus USDA</label>
                                                <br>
                                                <input class="form-control"  id="origen_usda" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12">
                        <div class="panel panel-info" style="display: block">
                            <div class="panel-heading" id="panel-info-header">Unidad de destino</div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <?= $form->field($model, 'c01_id')->widget(\kartik\widgets\Select2::className(),[
                                                'data' => \app\models\Ganaderos::getAllGanaderos(),
                                                'options' => ['placeholder' => 'Seleccionar un Productor...', 'id'=>'prod_destino', 'onchange'=>'cargarUnidadesDestino()', 'disabled'=>$bloqueo],
                                                'pluginOptions' => [
                                                    'allowClear' => true,
                                                    'minimumInputLength' => 5,
                                                ],
                                            ]) ?>

                                            <label >&nbsp</label>
                                            <span class="input-group-btn">
                                                <button type="button" onclick="abrirProductores()" class="btn btn-info btn-flat col-xs-12" style="color: white; border-color: #942626; background-color: #942626";">Agregar Productor</button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <?= $form->field($model, 'r01_destino')->widget(\kartik\widgets\Select2::className(),[
                                                'options' => ['placeholder' => 'Seleccionar una unidad de producción...', 'onchange'=>'unidadDestino()', 'id'=>'id_destino', 'disabled'=>$bloqueo],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ]) ?>

                                            <label >&nbsp</label>
                                            <span class="input-group-btn">
                                                <button type="button" onclick="abrirUnidades()" class="btn btn-info btn-flat col-xs-12" style="color: white; border-color: #942626; background-color: #942626";">Agregar Unidad</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label> Calle y número ext. e int.</label>
                                                <br>
                                                <input class="form-control"  id="destino_calle" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Colonia</label>
                                                <br>
                                                <input class="form-control"  id="destino_col" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Código postal</label>
                                                <br>
                                                <input class="form-control"  id="destino_cp" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Estado</label>
                                                <br>
                                                <input class="form-control"  id="destino_edo" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Municipio o Delegación</label>
                                                <br>
                                                <input class="form-control"  id="destino_mpo" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Localidad</label>
                                                <br>
                                                <input class="form-control"  id="destino_loc" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Cuarentena</label>
                                                <br>
                                                <input class="form-control"  id="destino_estatus" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                            <!--<div class="col-md-2">
                                                <label>Zona</label>
                                                <br>
                                                <input class="form-control"  id="destino_zona" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Estatus SENASICA</label>
                                                <br>
                                                <input class="form-control"  id="destino_senasica" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Estatus USDA</label>
                                                <br>
                                                <input class="form-control"  id="destino_usda" style="margin-left: 2px; 2px; text-align:left" readonly>
                                            </div>-->
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12">
                        <div class="panel panel-info" style="display: block">
                            <div class="panel-heading" id="panel-info-header">Detalle de documentación</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                            <?= $form->field($model, 'p11_guia')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>
                                    </div>
                                    <div class="col-md-4">
                                            <?= $form->field($model, 'p11_fecha')->widget(DatePicker::classname(), [
                                                'value' => date('d/M/Y'),
                                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                'pluginOptions' => ['autoclose' => true, 'format' => 'yyyy-mm-dd', 'todayHighlight'=>true, 'endDate'=>'+5d', 'startDate'=>'0d',]
                                            ]) ?>
                                    </div>
                                    <div class="col-md-4">
                                            <?= $form->field($model, 'p11_especie')->widget(\kartik\widgets\Select2::className(),[
                                                'data' => \app\models\Especies::getAllEspecies(),
                                                'options' => ['placeholder' => 'Seleccionar especie...', 'id'=>'especc', 'disabled'=>$bloqueo, 'onchange'=>'buscarArete()'],
                                                'pluginOptions' => [
                                                    'allowClear' => true
                                                ],
                                            ]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'p11_motivo')->textInput(['maxlength' => true, 'value'=> 'EXPORTACIÓN', 'readonly'=> true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $form->field($model, 'p11_aux')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12">
                        <div class="panel panel-info" style="display: block">
                            <div class="panel-heading" id="panel-info-header">Tabla de aretes</div>
                            <div class="panel-body">

                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="panel panel-info" style="display: block">
                                            <div class="panel-heading" id="panel-info-header">Capturar arete</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Identificador</label><br>
                                                        <input class="form-control" maxlength="10" id="cap_are" autocomplete="off" onkeyup="buscarArete()" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="Ej. 1409600001"  <?php if($bloqueo) echo "readonly";?> autofocus>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Edad</label><br>
                                                        <input class="form-control"  id="cap_edad" style="margin-left: 2px; 2px; text-align:left" autocomplete="off">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="raza">Raza</label>
                                                        <label for="raza2"></label>
                                                        <?=
                                                        '<div class="input-group input-daterange">'.
                                                        Html::dropDownList("", null, \app\models\Razas::getAllRazas(1), ["class" => "form-control", "id"=>"cap_raza"]).
                                                        '<span class="input-group-addon kv-field-separator">/</span>'.
                                                        Html::dropDownList("", null, \app\models\Razas::getAllRazas(1), ["class" => "form-control", "id"=>"cap_raza2", "prompt" => "..."]).
                                                        '</div>'
                                                        ?>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Sexo</label><br>
                                                        <?=
                                                        Html::dropDownList("", null, [ '1'=>'H','0'=>'M'], ["class" => "form-control", "id"=>"cap_sexo"]);
                                                        ?>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <label class="control-label" for="botonOk">&nbsp;</label>
                                                        <button type="button" id="btnAgregar" onclick="agregarArete(<?=$editando?>)" class="btn btn-info btn-flat col-xs-12" style="color: white; border-color: #942626; background-color: #942626";">Agregar</button>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="panel panel-info" style="display: block">
                                                            <div class="panel-heading" id="panel-info-header">TB</div>
                                                            <div class="panel-body">
                                                                    <div class="col-md-6">
                                                                        <label>Folio</label><br>
                                                                        <input class="form-control" maxlength="10" id="cap_tb" autocomplete="off" onkeyup="buscarTBFolio()" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder=""  <?php if($bloqueo) echo "readonly";?> autofocus>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Resultado</label><br>
                                                                        <?=
                                                                        Html::dropDownList("", null, [ '4'=>'NEGATIVO', '5'=>'SOSPECHOSO', '6'=>'REACTIVO', '7'=>'*'], ["class" => "form-control", "onkeyup"=> "buscarTBResultadoFolio()", "id"=>"cap_res_tb"]);
                                                                        ?>
                                                                    </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="panel panel-info" style="display: block">
                                                            <div class="panel-heading" id="panel-info-header">BR</div>
                                                            <div class="panel-body">
                                                                <div class="col-md-6">
                                                                    <label>Folio</label><br>
                                                                    <input class="form-control" maxlength="10" id="cap_br" autocomplete="off" onkeyup="buscarBRFolio()" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder=""  <?php if($bloqueo) echo "readonly";?> autofocus>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Resultado</label><br>
                                                                    <?=
                                                                    Html::dropDownList("", null, \app\models\Resultados::getResultadoTipo(0), ["class" => "form-control", "id"=>"cap_res_br", "onkeyup"=> "buscarBRResultadoFolio()"]);
                                                                    ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Factura</label><br>
                                                        <input class="form-control" maxlength="10" id="cap_factura" autocomplete="off" placeholder=""  <?php if($bloqueo) echo "readonly";?> autofocus>
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
                                                        return $info->r28_numero;
                                                    },

                                                ],
                                                [
                                                    'label'=>'Edad',
                                                    'contentOptions'=>[
                                                        "align"=>"center",
                                                        "width"=>"10%",
                                                    ],
                                                    'value'=>function($info){
                                                        return $info->r28_edad;
                                                    },

                                                ],

                                                [
                                                    'label'=>'Raza',
                                                    'contentOptions'=>[
                                                        "align"=>"center",
                                                        "width"=>"10%",
                                                    ],
                                                    'value'=>function($info){
                                                        $raza = \app\models\Razas::findOne($info->r28_raza)->c06_clave;
                                                        if($info->r28_raza2)
                                                            $raza .=  '/'.\app\models\Razas::findOne($info->r28_raza2)->c06_clave;
                                                        return $raza;
                                                    },

                                                ],
                                                [
                                                    'label'=>'Sexo',
                                                    'contentOptions'=>[
                                                        "align"=>"center",
                                                        "width"=>"10%",
                                                    ],
                                                    'value'=>function($info){
                                                        if($info->r28_sexo==1)
                                                            return 'Hembra';
                                                        else
                                                            return 'Macho';
                                                    },

                                                ],
                                                [
                                                    'label'=>'Folio TB',
                                                    'contentOptions'=>[
                                                        "align"=>"center",
                                                        "width"=>"10%",
                                                    ],
                                                    'value'=>function($info){
                                                        return $info->r28_tb;
                                                    },

                                                ],
                                                [
                                                    'label'=>'Folio BR',
                                                    'contentOptions'=>[
                                                        "align"=>"center",
                                                        "width"=>"10%",
                                                    ],
                                                    'value'=>function($info){
                                                        return $info->r28_br;
                                                    },

                                                ],
                                                [
                                                    'label'=>'Factura',
                                                    'contentOptions'=>[
                                                        "align"=>"center",
                                                        "width"=>"10%",
                                                    ],
                                                    'value'=>function($info){
                                                        return $info->r28_factura;
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
                                                            'url'=> \yii\helpers\Url::toRoute(['exportacion/deletearete','id'=>$info->r28_id]),
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
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>


