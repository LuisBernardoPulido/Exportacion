<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Upp */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_unidades.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/mensaje_guardado.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_entidades_upp.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/agregar_localidad_upp.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">UPPS Y PSGS</div>
    <div class="panel-body">

<div class="upp-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    if($model->isNewRecord){
        $id = -1;
    }else{
        $id = $model->r01_id;
    }
    ?>
    <input type="hidden" id="id_edo" value="<?=$id?>">
    <input type="hidden" id="id_first_time" value="0">
    <input type="hidden" id="id_first_time_mun" value="0">

    <br>
    <div class="panel panel-info" id="panel-info-mpc">
        <div class="panel-heading" id="panel-info-header">Información de la Unidad</div>
        <div class="panel-body">

            <div class="row">
                <div class="col-xs-4">
                    <?= $form->field($model, 'r01_tipo')->dropDownList([ '0' => 'UPP', '1' => 'PSG']) ?>
                </div>
            </div>

        <div class="row">
                <div class="col-sm-6 col-md-4">
                    <?= $form->field($model, 'r01_clave')->textInput(['maxlength' => true, 'autofocus'=>true]) ?>
                    <span class="help-block" id="val_clave" style="color: #FF0000;margin-left:15px; display: none"></span>

                    <?php
                    if($model->isNewRecord){
                        ?>
                        <input type="hidden" id="cve_temp" value="-1">
                        <?php
                    }else {
                        ?>
                        <input type="hidden" id="cve_temp" value="<?=$model->r01_clave?>">
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'r01_nombre')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'r01_superficie')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'r01_calle')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'r01_colonia')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'r01_cp')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'r01_estado')->widget(\kartik\widgets\Select2::className(),[
                        'data' => \app\models\Estados::getAllEstados(),
                        'options' => ['placeholder' => 'Seleccionar estado...', 'onchange' => 'cargarMunicipiosUpp()'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]) ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'r01_municipio')->widget(\kartik\widgets\Select2::className(),[
                        'data' => \app\models\Municipios::getAllMuns(),
                        'options' => ['placeholder' => 'Seleccionar municipio...', 'onchange' => 'cargarlocalidadesUpp()'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <?= $form->field($model, 'r01_localidad')->widget(\kartik\widgets\Select2::className(),[
                            'data' => \app\models\LocalidadesZac::getAllLocalidades(),
                            'options' => ['placeholder' => 'Seleccionar localidad...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>
                            <br>
                            <label for="botonMas">&nbsp;</label>
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="botonMas"  onclick="agregarLocalidad()" style="color: white; border-color: #942626; background-color: #942626";"><i class="fa fa-plus"></i></button>
                        </span>
                    </div>
                </div>

            </div>
            <!--<?= $form->field($model, 'r01_faretado')->textInput(['maxlength' => true]) ?>-->
            <div class="row">
                <div class="col-md-4">
                        <?= $form->field($model, 'r01_tenencia')->widget(\kartik\widgets\Select2::className(), [
                            'data' => \app\models\Tenencias::getAllTenencias(),
                            'options' => ['placeholder' => 'Seleccionar tenencia...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>

                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'r01_zona')->widget(\kartik\widgets\Select2::className(), [
                        'data' => \app\models\Zonas::getAllZonas(),
                        'options' => ['placeholder' => 'Seleccionar zona...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>

                <div class="col-md-0">
                   <!-- <p>Ingresar imágen de fierro:</p>
                    <?= Html::fileInput(['required' => false, 'class'=>'form-control']);?>-->
                </div>

            </div>
<br>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-info" style="display: block">
                        <div class="panel-heading" id="panel-info-header">Posición Geográfica</div>
                        <div class="panel-body">
                            <div class="col-md-4">
                                <?= $form->field($model, 'r01_latitud')->textInput(['type'=>'text', 'step'=>'any','maxlength' => true]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'r01_longitud')->textInput(['type'=>'text', 'step'=>'any', 'maxlength' => true]) ?>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="panel panel-info" id="productores_por_unidad" style="display: block">
        <div class="panel-heading" id="panel-info-header">Productores de la UPP o PSG</div>
        <div class="panel-body">
            <?php
            if($model->isNewRecord){
                $indicador=-1;
            }else{
                $indicador=$model->r01_id;
            }

            ?>

            <?php \yii\widgets\Pjax::begin([ 'id' => 'grid-productos']);?>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $relaciones,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label'=>'CURP / RFC',
                        'value'=>function($relaciones){
                            $model=\app\models\Ganaderos::findOne($relaciones->c01_id);
                            if($model->c01_tipo==0) {
                                return strtoupper($model->c01_curp);
                            }else{
                                return strtoupper($model->c01_rfc);
                            }
                        }
                    ],

                    [
                        'label'=>'Nombre',
                        'value'=>function($relaciones){
                            $model=\app\models\Ganaderos::findOne($relaciones->c01_id);
                            if($model->c01_tipo==0) {
                                return strtoupper($model->c01_nombre) . ' ' . strtoupper($model->c01_apaterno) . ' ' . strtoupper($model->c01_amaterno);
                            }else{
                                return strtoupper($model->c01_razonsocial);
                            }
                        }
                    ],

                    [
                        'attribute' => 'Acción',
                        'format' => 'raw',
                        'contentOptions'=>[
                            "width"=>"6%",
                        ],
                        'visible'=>$model->isNewRecord?false:true,
                        'value' => function($relaciones){
                            $editar='<a href="index.php?r=ganaderos/update&id='.$relaciones->c01_id.'&edicion='.$relaciones->r01_id.'" title="Editar" aria-label="Editar" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';

                            $eliminar='<a href="'.\yii\helpers\Url::toRoute(['delete_productor','id'=>$relaciones->r04_id]).'" title="Eliminar" class="ajaxDelete" aria-label="Eliminar" data-confirm="¿Está seguro de eliminar este elemento?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>';
                            return $editar.' &nbsp;'.$eliminar;
                        }
                    ],
                ],
            ]); ?>.

            <?php
            $script="$('#modalContent2').load(document.getElementById('modalButton').value);";
            $this->registerJs($script, \yii\web\View::POS_READY, 'ganadero-unidades');?>
            <div id ='modalContent2'></div>
            <input type="hidden" id="modalButton"  value="index.php?r=unidades/add_productor&indicador=<?=$indicador?>">
            <?php \yii\widgets\Pjax::end(); ?>
        </div>

    </div>

    <br>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-primary button_crear' : 'btn btn-primary']) ?>
            </div>
    </div>




   <!-- <?= $form->field($model, 'r01_mostrar')->textInput() ?>

    <?= $form->field($model, 'r01_usuAlta')->textInput() ?>

    <?= $form->field($model, 'r01_fecAlta')->textInput() ?>

    <?= $form->field($model, 'r01_usuMod')->textInput() ?>

    <?= $form->field($model, 'r01_fecMod')->textInput() ?>-->



    <?php ActiveForm::end(); ?>

</div>
</div>
