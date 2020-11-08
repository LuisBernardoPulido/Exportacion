<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_add_grid.js', ['depends' => [\yii\web\JqueryAsset::className()]] );
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_productores.js', ['depends' => [\yii\web\JqueryAsset::className()]] );

?>

<div class="permiso-form">

    <?php

    $url_upp = \yii\helpers\Url::to(['unidades/upplist']);
    $form = ActiveForm::begin([
        "options" => ["enctype" => "multipart/form-data", 'id'=>'frm_producto' ]
    ]);

    ?>

    <?= $form->errorSummary($model, ['header' => '']) ?>
    <div class="row">
        <div class="col-md-6">
            <!--<div class="form-group">-->
            <?= $form->field($model, 'r01_id')->widget(\kartik\widgets\Select2::className(),[
                'data' => $items,
                //'options' => ['placeholder' => 'Seleccionar Clave UPP...', 'onchange'=>'existente()'],
                'options' => ['placeholder' => 'Agregar por Clave UPP...', 'onchange'=>'existente()'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 6,
                    'language' => [
                        'errorLoading' => new \yii\web\JsExpression("function () { return 'Esperando por resultados...'; }"),
                    ],
                    'ajax' => [
                        'url' => $url_upp,
                        'dataType' => 'json',
                        'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new \yii\web\JsExpression('function(upp) { return upp.text; }'),
                    'templateSelection' => new \yii\web\JsExpression('function (upp) { return upp.text; }'),
                ],
            ])->label('Asignar UPP al Ganadero')
            ?>
        </div>

        <div class="col-md-6">
            <br>
            <?= Html::button('Agregar', ['onclick' => "add_grid({url:'". Url::to('index.php?r=ganaderos/add_unidad&indicador='.$indicador)."', param:'frm_producto', grid:'grid-productos' } )", 'class' => 'btn btn-primary ', 'id' => 'modalButton']) ?>
            <!--</div>-->
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>