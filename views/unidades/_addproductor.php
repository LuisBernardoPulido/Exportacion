<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_add_grid.js', ['depends' => [\yii\web\JqueryAsset::className()]] );
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_unidades.js', ['depends' => [\yii\web\JqueryAsset::className()]] );
$urlganadero = \yii\helpers\Url::to(['ganaderos/ganlist']);
?>

<div class="permiso-form">

    <?php
    $form = ActiveForm::begin([
        "options" => ["enctype" => "multipart/form-data", 'id'=>'frm_producto' ]
    ]);

    ?>

    <?= $form->errorSummary($model, ['header' => '']) ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'c01_id')->widget(\kartik\widgets\Select2::className(),[
                'data' => $items,
                //'options' => ['placeholder' => 'Agregar por CURP...', 'onchange'=>'existente()'],
                'options' => ['placeholder' => 'Agregar por CURP...', 'onchange'=>'existente()'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 5,
                    'language' => [
                        'errorLoading' => new \yii\web\JsExpression("function () { return 'Esperando por resultados...'; }"),
                    ],
                    'ajax' => [
                        'url' => $urlganadero,
                        'dataType' => 'json',
                        'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new \yii\web\JsExpression('function(gan) { return gan.text; }'),
                    'templateSelection' => new \yii\web\JsExpression('function (gan) { return gan.text; }'),
                ],
            ])->label('Asignar otro Productor a la UPP')
            ?>
        </div>
        <div class="col-md-6">
            <br>
            <?= Html::button('Agregar', ['onclick' => "add_grid({url:'". Url::to('index.php?r=unidades/add_productor&indicador='.$indicador)."', param:'frm_producto', grid:'grid-productos' } )", 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>