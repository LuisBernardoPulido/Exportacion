<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Solicitudes */
/* @var $form yii\widgets\ActiveForm */


$this->registerJsFile(Yii::$app->request->baseUrl . '/js/mensaje_guardado.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_enter.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_del_grid.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_scroll.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile('css/style_mpc.css');
?>

<?php

$cityDesc = empty($model->p01_upp) ? '' : \app\models\Upp::findOne($model->p01_upp)->r01_id;
$cityDescrip = empty($model->p01_upp) ? '' : \app\models\Upp::findOne($model->p01_upp)->r01_clave.' - '.\app\models\Upp::findOne($model->p01_upp)->r01_nombre;
if($model->isNewRecord){
    $disable = false;
    $disabled = true;
    $ideResena = -1;
    $enabled=6;
    $url = \yii\helpers\Url::to(['upplists']);
    $identificador_resena = -1;

        $aretes = \app\models\Aretes::getAretesNo(1);
    $activar_upp = false;
}else {
    $especie = $model->p01_especie;
    if(\app\models\User::isUserAdmin(Yii::$app->user->getId()))
        $activar_upp = false;
    else
        $activar_upp = true;
    $disable = true;
    $disabled = false;
    $ideResena=$model->r01_upp;
    $enabled=6;
    $url = \yii\helpers\Url::to(['upplists']);
    $identificador_resena=$model->p01_id;
}
?>


<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Datos de solicitud</div>
    <div class="panel-body">
        <div class="resenas-form">

            <?php $form = ActiveForm::begin(); ?>


            <div class="panel panel-info" id="panel-info-mpc">
                <div class="panel-heading" id="panel-info-header">Datos de PSG</div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'r01_id')->widget(\kartik\widgets\Select2::className(),[
                                //'data' => \app\models\Upp::getUppsPorProductor($model->p01_ganadero),
                                'value'=>$cityDesc,
                                'hideSearch'=>true,
                                'initValueText' => $cityDescrip,
                                'options' => ['placeholder' => 'Seleccionar unidad de producción...', 'onchange'=>'asignarUPP()', 'disabled'=>$activar_upp],
                                'pluginOptions' => [
                                    'allowClear' => $disabled,
                                    'minimumInputLength' => $enabled,
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
                    <div class="row">
                        <div class="col-md-6">

                            <span class="help-block" id="error_mensaje" style="color: #FF0000;margin-left:15px; display: none">Upp ya reseñada</span>
                        </div>
                    </div>
                </div>
            </div>




            <?php
            if($model->isNewRecord){
                echo '<div class="panel panel-info bloquearetes" id="panel-info-tb" style="display: block">';
            }else{
                echo '<div class="panel panel-info bloquearetes" id="panel-info-tb" style="display: block">';
            }
            ?>

            <div class="panel-heading" id="panel-info-header">Aretes</div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="panel panel-info" id="panel-info-tb">
                            <div class="panel-heading" id="panel-info-header">

                       Arete
                            </div>
                            <div class="panel-body" id="aretespor" style="display: block">
                                <!--Por aretes-->

                                <div class="row">

                                    <div class="col-xs-8">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label for="por_arete">Arete</label>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-xs-10">
                                                <input class="form-control" maxlength="10" onfocusout="buscarArete()" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" id="por_arete" placeholder="Ej. 3209800001"  autofocus>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xs-4">
                                        <label class="control-label" for="botonOk">&nbsp;</label>
                                        <button type="button" id="botonOkPorArete" onclick="arete(<?=$ideResena?>, <?=$identificador_resena?>)" class="btn btn-info btn-flat col-xs-12" style="color: white; border-color: #942626; background-color: #942626";">Agregar</button>
                                    </div>
                                </div>
                                <!--Fin de por arete-->
                            </div>

                            <span class="help-block" id="error_mensaje2" style="color: #FF0000;margin-left:15px; display: none">Número(s) de arete(s) incorrecto(s)</span>
                            <span class="help-block" id="error_mensaje3" style="color: #FF0000;margin-left:15px; display: none">Arete ya existente</span>
                        </div>
                    </div>



                </div><br>

                <div class="row" id="header_auxiliar_grid"  style="margin-left: 1px; display: none;">
                    <div class="summary" style="margin-bottom: 6px;">Mostrando <b id="totales_res">1 - 0</b> de <b id="totales_res_total">124</b> elementos</div>

                    <div class="col-xs-12">
                        <table class="col-xs-12">
                            <thead>
                            <tr>
                                <th style="width: 5.55%">#</th>
                                <th style="width: 18.51%">Arete</th>
                                <th style="width: 18.51%">Edad</th>
                                <th style="width: 27.77%">Raza</th>
                                <th style="width: 18.51%">Sexo</th>
                                <th style="width: 11.11%">Accion</th>
                            </tr>

                            </thead>
                        </table>

                    </div>
                </div>
                <br>

                <div class="scrolles" id="scrolll">
                    <div class="row">

                        <div class="col-xs-12">
                            <?php \yii\widgets\Pjax::begin(['id' => 'tablat']); ?>
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
                                        'value'=>function($data){
                                            /*return Yii::$app->db
                                                ->createCommand('SELECT SUBSTRING(r02_numero,3,10) FROM r02_aretes WHERE r02_id=:id')
                                                ->bindValue(':id', \app\models\Aretes::findOne($data->r02_id)->r02_id)->queryScalar(); ;*/
                                            return \app\models\Aretes::findOne($data->r02_id)->r02_numero;
                                        },

                                    ],

                                    [
                                        'label' => 'Edad',
                                        'contentOptions'=>[
                                            "width"=>"10%",
                                            "align"=>"center",
                                        ],
                                        'value' => function($aretes) {
                                            if(\app\models\Aretes::findOne($aretes->r02_id)->p01_isfechadefinitiva){
                                                return \app\models\Aretes::findOne($aretes->r02_id)->r02_edad.
                                                    Html::hiddenInput("edad[]", \app\models\Aretes::findOne($aretes->r02_id)->r02_edad).
                                                    Html::hiddenInput("id_r02[]", $aretes->r02_id);
                                            }else{
                                                return Html::input("text", "edad[]", \app\models\Aretes::findOne($aretes->r02_id)->r02_edad, ["class" => "form-control edadtabla", 'min'=>'0', 'style'=>'text-align:right;', 'required'=>true, 'onblur'=>"edadupdate(this, ".$aretes->r02_id.", 0)"]).
                                                    Html::hiddenInput("id_r02[]", $aretes->r02_id);
                                            }
                                        },
                                        'format' => 'raw'
                                    ],


                                    [
                                        'label' => 'Raza',
                                        'contentOptions'=>[
                                            "width"=>"15%",
                                        ],
                                        'value' => function($aretes) {

                                            $content = '<div class="input-group input-daterange">
                                '.Html::dropDownList("raza[]", \app\models\Aretes::findOne($aretes->r02_id)->r02_raza, \app\models\Razas::getAllRazas($aretes->r02_especie), ["class" => "form-control", 'onblur'=>"edadupdate(this, ".$aretes->r02_id.", 1, ".$aretes->r02_raza2.")"]).'
                                <span class="input-group-addon kv-field-separator">/</span>
                                 '.Html::dropDownList("raza2[]", \app\models\Aretes::findOne($aretes->r02_id)->r02_raza2, \app\models\Razas::getAllRazas($aretes->r02_especie), ["class" => "form-control", "prompt" => "...", 'onblur'=>"edadupdate(this, ".$aretes->r02_id.", 2, ".$aretes->r02_raza.")"]).'
                            </div>';
                                            return $content;

                                        },
                                        'format' => 'raw'
                                    ],

                                    [
                                        'label' => 'Sexo',
                                        'contentOptions'=>[
                                            "width"=>"10%",
                                        ],
                                        'value' => function($aretes) {
                                            return Html::dropDownList("sexo[]", \app\models\Aretes::findOne($aretes->r02_id)->r02_sexo, [ '1'=>'Hembra','0'=>'Macho'], ["class" => "form-control", 'onblur'=>"edadupdate(this, ".$aretes->r02_id.", 3)"]);

                                        },
                                        'format' => 'raw'
                                    ],

                                    [
                                        'label' => 'Especie',
                                        'contentOptions'=>[
                                            "width"=>"10%",
                                        ],
                                        'visible'=>false,
                                        'value' => function($aretes) {
                                            return Html::dropDownList("especie[]", \app\models\Aretes::findOne($aretes->r02_id)->r02_especie, \app\models\Especies::getAllEspecies(), ["class" => "form-control", "tabindex"=>"-1", 'disabled'=>true]);
                                        },
                                        'format' => 'raw'
                                    ],
                                    [
                                        'attribute' => 'Acción',
                                        'format' => 'raw',
                                        'contentOptions'=>[
                                            "width"=>"6%",
                                        ],
                                        'value' => function($data) {
                                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',false, [
                                                'class'=>'ajaxDelete',
                                                'url'=> \yii\helpers\Url::toRoute(['resenas/delete_arete','id'=>$data->r02_id]),
                                                'grid'=>'tablat',
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


        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-primary button_crear' : 'btn btn-primary button_crear']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div></div>

