<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Typeahead;

$this->registerJsFile(Yii::$app->request->baseUrl . '/js/mensaje_guardado.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_productores.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_entidades_productores.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/agregar_localidad_ganaderos.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $model app\models\Ganaderos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-12">

<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">PRODUCTORES</div>
    <div class="panel-body">

<div class="ganaderos-form">
    <p align="right">
        <?= Html::a('Nueva solicitud', ['exportacion/create'], ['class' => 'btn btn-danger', 'title'=>'Crear nueva solicitud de exportación']) ?>
    </p>
    <?php $form = ActiveForm::begin(); ?>
    <?php

    if($model->isNewRecord){
        $id = -1;
    }else{
        $id = $model->c01_id;
    }
    ?>
    <input type="hidden" id="id_edo" value="<?=$id?>">
    <input type="hidden" id="id_mpo" value="<?=$id?>">
    <input type="hidden" id="id_first_time" value="0">
    <input type="hidden" id="id_first_time_mun" value="0">

        </div>

            <div class="panel panel-info" id="panel-info-mpc">
                <div class="panel-heading" id="panel-info-header">Información del Productor</div>
                <div class="panel-body">

                <div class="row">
                    <div class="col-xs-4">
                        <?= $form->field($model, 'c01_tipo')->dropDownList([ '0' => 'Física', '1' => 'Moral'], ['onchange'=>'tipoPersona()', 'autofocus'=>true]) ?>
                    </div>
                </div>

                <?php
                if($model->isNewRecord){
                    echo '<div class="row"  id="moral" style="display: none">';
                }else{
                    if($model->c01_tipo==1){
                        echo '<div class="row"  id="moral">';
                    }else{
                        echo '<div class="row"  id="moral" style="display: none">';
                    }
                }
                ?>
                <div class="col-sm-4 col-md-4">
                    <?= $form->field($model, 'c01_rfc')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>
                    <span class="help-block" id="rfc_rep" style="color: #FF0000;margin-left:15px; display: none"></span>

                    <?php
                    if($model->isNewRecord){
                        ?>
                        <input type="hidden" id="rfc_temp" value="-1">
                        <?php
                    }else {
                        ?>
                        <input type="hidden" id="rfc_temp" value="<?=$model->c01_rfc?>">
                        <?php
                    }
                    ?>
                </div>
                <div class="col-sm-8 col-md-8">
                    <?= $form->field($model, 'c01_razonsocial')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>
                </div>
            </div>


            <!--<div class="col-sm-4 col-md-12">-->
                <div class="row" >
                    <?php
                    if($model->isNewRecord){
                        echo '<div class="col-md-4" id="curp">';
                    }else{
                        if($model->c01_tipo==1){
                            echo '<div class="col-md-4" id="curp" style="display: none;">';
                        }else{
                            echo '<div class="col-md-4" id="curp">';
                        }
                    }
                    ?>

                    <?= $form->field($model, 'c01_curp')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>

                    <?php
                    if($model->isNewRecord){
                    ?>
                        <input type="hidden" id="curp_temp" value="-1">
                    <?php
                    }else {
                    ?>
                        <input type="hidden" id="curp_temp" value="<?=$model->c01_curp?>">
                    <?php
                    }
                    ?>

                    <span class="help-block" id="curp_rep" style="color: #FF0000;margin-left:15px; display: none"></span>
                    </div>
                </div>

            <div class="row">
                <div class="col-sm-4 col-md-4">

                    <?=$form->field($model, 'c01_apaterno')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>

                    <!--<?php
                    if($model->isNewRecord) {
                        $data = \app\models\Ganaderos::find()
                            //->select(['c01_apaterno as value', 'CONCAT(if(LENGTH(c01_nombre)!=0, UPPER(c01_nombre),\'\'),\' \',if(LENGTH(c01_apaterno)!=0, UPPER(c01_apaterno),\'\'),\' \',if(LENGTH(c01_amaterno)!=0, UPPER(c01_amaterno),\'\'), \' - \',if(LENGTH(c01_curp)!=0, UPPER(c01_curp),\'\') ) as label', 'c01_id as id'])
                            ->select(['c01_apaterno as value', 'CONCAT(if(LENGTH(c01_apaterno)!=0, UPPER(c01_apaterno),\'\'),\' \',if(LENGTH(c01_amaterno)!=0, UPPER(c01_amaterno),\'\'),\' \',if(LENGTH(c01_nombre)!=0, UPPER(c01_nombre),\'\'), \'  \',if(LENGTH(c01_curp)!=0, UPPER(c01_curp),\'\') ) as label', 'c01_id as id'])
                            ->asArray()
                            ->all();

                        ?>
                        <?= $form->field($model, 'c01_apaterno')->widget(\yii\jui\AutoComplete::classname(), [
                            'clientOptions' => [
                                'source' => $data,
                                'class' => 'form-control',
                                'minLength' => '3',
                                'autoFill' => true,
                                'select' => new \yii\web\JsExpression("function( event, ui ) {
                                //console.log(ui.item.id);
                                //$('#ganaderos-c01_apaterno').val(ui.item.id);
                                mostrarmodal(ui.item.id);
                                
                            }")
                            ],
                            'options' => [
                                'class' => 'form-control',
                                //'font-size'=>'8px',
                            ],
                            'id' => 'ddd',
                        ]) ?>
                        <?php
                    }else {
                        ?>
                        <?=$form->field($model, 'c01_apaterno')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>

                        <?php
                    }
                    ?>-->

                </div>
                <div class="col-sm-4 col-md-4">
                    <?= $form->field($model, 'c01_amaterno')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'c01_nombre')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'c01_calle')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'c01_colonia')->textInput(['maxlength' => true, 'style'=>'text-transform:uppercase;', 'autocomplete'=>'off']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'c01_cp')->textInput(['maxlength' => true, 'autocomplete'=>'off']) ?>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'c01_estado')->widget(\kartik\widgets\Select2::className(),[
                        'data' => \app\models\Estados::getAllEstados(),
                        'options' => ['placeholder' => 'Seleccionar estado...', 'onchange' => 'cargarMunicipiosProductor()'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'c01_municipio')->widget(\kartik\widgets\Select2::className(),[
                        //'data' => \app\models\Municipios::getAllMuns(),
                        'options' => ['placeholder' => 'Seleccionar municipio...', 'onchange' => 'cargarlocalidadesProductor()' ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <?= $form->field($model, 'c01_localidad')->widget(\kartik\widgets\Select2::className(),[
                            //'data' => \app\models\LocalidadesZac::getAllLocalidades(),
                            'options' => ['placeholder' => 'Seleccionar localidad...'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>
                        <!--<br>
                        <label for="botonMas">&nbsp;</label>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default" id="botonMas"  onclick="agregarLocalidad()" style="color: white; border-color: #942626; background-color: #942626";"><i class="fa fa-plus"></i></button>
                        </span>-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'c01_correo')->textInput(['maxlength' => true, 'autocomplete'=>'off']) ?>
                    <span class="help-block" id="val_email" style="color: #FF0000;margin-left:15px; display: none">El correo electrónico no es válido.</span>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'c01_telefono')->textInput(['maxlength' => true, 'autocomplete'=>'off']) ?>
                </div>
            </div>
                </div>
            </div>
            <div class="panel panel-info" id="unidades_por_productor" style="display: block">
                        <div class="panel-heading" id="panel-info-header">UPP del Productor</div>
                        <div class="panel-body">
                            <?php
                            if($model->isNewRecord){
                                $indicador=-1;
                            }else{
                                $indicador=$model->c01_id;
                            }

                            ?>

                                    <?php \yii\widgets\Pjax::begin([ 'id' => 'grid-productos']);?>
                                    <?= \yii\grid\GridView::widget([
                                        'dataProvider' => $relaciones,
                                        // 'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            [
                                                'label'=>'Clave UPP',
                                                'value'=>function($relaciones){
                                                    $model=\app\models\Upp::findOne($relaciones->r01_id);
                                                        return strtoupper($model->r01_clave);
                                                },
                                                'format' => 'raw'
                                            ],

                                            [
                                                'label'=>'Nombre de la UPP',
                                                'value'=>function($relaciones){
                                                    $model=\app\models\Upp::findOne($relaciones->r01_id);

                                                        return strtoupper($model->r01_nombre);

                                                },
                                                'format' => 'raw'
                                            ],
                                            [
                                                'label'=>'Último Dictamen TB',
                                                'contentOptions'=>[
                                                    "align"=>"center",
                                                ],
                                                'value'=>function($relaciones){
                                                    $dictamen_tb = "";
                                                    if($relaciones->c01_id)
                                                        $dictamen_tb = Yii::$app->db->createCommand('
                                                        SELECT p03_folio FROM p03_tb WHERE r01_id='.$relaciones->r01_id.' AND c01_id='.$relaciones->c01_id.' AND p03_folio ORDER BY p03_finyeccion DESC LIMIT 1
                                                        ')->queryScalar();

                                                    if($dictamen_tb)
                                                        return $dictamen_tb;
                                                    else
                                                        return 'N/A';

                                                },
                                                'format' => 'raw'
                                            ],
                                            [
                                                'label'=>'Aretes en TB',
                                                'contentOptions'=>[
                                                    "align"=>"center",
                                                ],
                                                'value'=>function($relaciones){
                                                    $aretes_tb = "";
                                                    if($relaciones->c01_id)
                                                        $aretes_tb = Yii::$app->db->createCommand('
                                                        SELECT COUNT(*) FROM r06_tuberculosis_aretes WHERE p03_tb = (SELECT p03_id FROM p03_tb WHERE r01_id='.$relaciones->r01_id.' AND c01_id='.$relaciones->c01_id.' AND p03_folio ORDER BY p03_finyeccion DESC LIMIT 1)
                                                        ')->queryScalar();

                                                    if($aretes_tb)
                                                        return $aretes_tb;
                                                    else
                                                        return 'N/A';

                                                },
                                                'format' => 'raw'
                                            ],
                                            [
                                                'label'=>'Último Dictamen BR',
                                                'contentOptions'=>[
                                                    "align"=>"center",
                                                ],
                                                'value'=>function($relaciones){
                                                    $dictamen_br = "";
                                                    if($relaciones->c01_id)
                                                        $dictamen_br = Yii::$app->db->createCommand('
                                                        SELECT p03_folio FROM p03_br WHERE r01_id='.$relaciones->r01_id.' AND c01_id='.$relaciones->c01_id.' AND p03_folio ORDER BY p03_fmuestreo DESC LIMIT 1
                                                        ')->queryScalar();

                                                    if($dictamen_br)
                                                        return $dictamen_br;
                                                    else
                                                        return 'N/A';

                                                },
                                                'format' => 'raw'
                                            ],
                                            [
                                                'label'=>'Aretes en BR',
                                                'contentOptions'=>[
                                                    "align"=>"center",
                                                ],
                                                'value'=>function($relaciones){
                                                    $aretes_br = "";
                                                    if($relaciones->c01_id)
                                                        $aretes_br = Yii::$app->db->createCommand('
                                                        SELECT COUNT(*) FROM r07_brucelosis_aretes WHERE p03_br = (SELECT p03_id FROM p03_br WHERE r01_id='.$relaciones->r01_id.' AND c01_id='.$relaciones->c01_id.' AND p03_folio ORDER BY p03_fmuestreo DESC LIMIT 1)
                                                        ')->queryScalar();

                                                    if($aretes_br)
                                                        return $aretes_br;
                                                    else
                                                        return 'N/A';

                                                },
                                                'format' => 'raw'
                                            ],

                                            [
                                                'attribute' => 'Acción',
                                                'format' => 'raw',
                                                'contentOptions'=>[
                                                    "width"=>"6%",
                                                ],
                                                'visible'=>$model->isNewRecord?false:true,
                                                'value' => function($relaciones){
                                                    $eliminar='<a href="'.\yii\helpers\Url::toRoute(['delete_unidad','id'=>$relaciones->r04_id]).'" title="Eliminar" class="ajaxDelete" aria-label="Eliminar" data-confirm="¿Está seguro de eliminar este elemento?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>';
                                                    $editar='<a href="index.php?r=unidades/update&id='.$relaciones->r01_id.'&edicion='.$relaciones->c01_id.'" title="Editar" aria-label="Editar" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';

                                                    return $editar.' &nbsp;'.$eliminar;
                                                }
                                            ],
                                        ],
                                    ]); ?>

                            <?php
                            $script="$('#modalContent2').load(document.getElementById('modalButton').value);";
                            $this->registerJs($script, \yii\web\View::POS_READY, 'unidades-ganadero');?>
                            <br>
                            <div id ='modalContent2'></div>
                            <input type="hidden" id="modalButton"  value="index.php?r=ganaderos/add_unidad&indicador=<?=$indicador?>">
                                    <?php \yii\widgets\Pjax::end(); ?>
                                </div>

            </div>


            <br>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-primary button_crear' : 'btn btn-primary button_crear']) ?>
            </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
</div>
