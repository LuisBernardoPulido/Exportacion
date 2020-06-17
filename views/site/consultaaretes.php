<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\View;
use app\models\Utileria;

/**
 * Created by PhpStorm.
 * User: Edd
 * Date: 13/07/2017
 * Time: 12:49 PM
 */
$this->registerJsFile(Yii::$app->request->baseUrl . '/bootstrap-select-1.12.2/bootstrap-select.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->request->baseUrl.'/bootstrap-select-1.12.2/bootstrap-select.css');
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_busqueda.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'Consulta de Arete';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Consulta de información</div>
    <div class="panel-body">
        <div class="panel panel-info" id="panel-info-arete">
            <div class="panel-heading" id="panel-info-header">Consultar Arete</div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="bus_esp">&nbsp;&nbsp;&nbsp;&nbsp;&nbspEspecie</label>
                            </div>
                            <div class="col-xs-2">
                                <label for="bus_arete">Arete</label>
                            </div>
                            <div class="col-xs-1">
                                <label for="bus_edad">Edad</label>
                            </div>

                            <div class="col-xs-2">
                                <label for="bus_raza1">Raza</label>
                            </div>
                            <div class="col-xs-1">
                                <label for="bus_raza2"></label>
                            </div>
                            <div class="col-xs-2">
                                <label for="bus_sexo">Sexo</label>
                            </div>
                            <div class="col-xs-2">
                                <label for="bus_upp">UPP</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-2">
                                <select class="selectpicker col-xs-12" id="bus_esp" title="Seleccionar raza..." onchange="buscarArete()" autofocus>
                                    <!--<option value="0">Selecciona una opción</option>-->
                                    <option value="1">BOVINO</option>
                                    <option value="2">CAPRINO</option>
                                    <option value="3">OVINO</option>
                                </select>
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control" type="text" id="bus_arete" placeholder="Ej. 3209800001" required>
                            </div>
                            <div class="col-xs-1">
                                <input class="form-control" type="number" id="bus_edad" style="margin-left: 2px; text-align:center" readonly>
                            </div>
                            <div class="col-xs-3">
                                <div class="input-group input-daterange">
                                    <input class="form-control" id="bus_raza1" style="margin-left: 2px; text-align:center" readonly>
                                    <span class="input-group-addon kv-field-separator">/</span>
                                    <input class="form-control" id="bus_raza2" style="margin-left: 2px; 2px; text-align:center" readonly>
                                </div>
                            </div>

                            <div class="col-xs-2">
                                <input class="form-control" maxlength="3" min="0" id="bus_sexo" style="margin-left: 2px; 2px; text-align:center" readonly>
                            </div>
                            <div class="col-xs-2">
                                <input class="form-control" maxlength="3" min="0" id="bus_upp" style="margin-left: 2px; 2px; text-align:center" readonly>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<br>
