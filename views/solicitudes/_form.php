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
                            <label>Clave PSG</label>
                            <input type="text" class="form-control" value="32-049-1244-001" disabled="disabled" placeholder="Enter ...">
                        </div>
                        <div class="col-md-6">
                            <label>Nombre</label>
                            <input type="text" class="form-control" value="LA CARRETA" disabled="disabled" placeholder="Enter ...">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Localidad</label>
                            <input type="text" class="form-control" value="SAN MIGUEL" disabled="disabled" placeholder="Enter ...">
                        </div>
                        <div class="col-md-6">
                            <label>Municipio</label>
                            <input type="text" class="form-control" value="VALPARAISO" disabled="disabled" placeholder="Enter ...">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Propietario</label>
                            <input type="text" class="form-control" value="JUAN MANUEL ROSALES" disabled="disabled" placeholder="Enter ...">
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
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box">

                                        <!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="example2" class="table table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Arete</th>
                                                    <th>Municipio</th>
                                                    <th>UPP</th>
                                                    <th>Dictamen TB</th>
                                                    <th>Guía de transito</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>327687245</td>
                                                    <td>Fresnillo
                                                    </td>
                                                    <td>32-033-1181-001</td>
                                                    <td> 38787765</td>
                                                    <td><input type="text" ></td>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>327687245</td>
                                                    <td>Zacatecas
                                                    </td>
                                                    <td>32-033-1181-00</td>
                                                    <td>38787763</td>
                                                    <td><input type="text" ></td>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></td>

                                                </tr>
                                                <tr>
                                                    <td>327687245</td>
                                                    <td>Valparaiso
                                                    </td>
                                                    <td>32-049-0350-212</td>
                                                    <td>22787765</td>
                                                    <td><input type="text" ></td>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></td>

                                                </tr>
                                                <tr>
                                                    <td>327687245</td>
                                                    <td>Fresnillo
                                                    </td>
                                                    <td>32-033-1181-00</td>
                                                    <td>45787765</td>
                                                    <td><input type="text" ></td>

                                                    <td><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></td>

                                                </tr>
                                                <tr>
                                                    <td>327687245</td>
                                                    <td>Fresnillo</td>
                                                    <td>32-033-1194-001</td>
                                                    <td>38787765</td>
                                                    <td><input type="text" ></td>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></td>

                                                </tr>
                                                <tr>
                                                    <td>327687245</td>
                                                    <td>Fresnillo</td>
                                                    <td>32-015-1081-001</td>
                                                    <td>38787765</td>
                                                    <td><input type="text" ></td>
                                                    <td><i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></td>

                                                </tr>



                                                </tbody>

                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->

                        </div>
                        </div>
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

