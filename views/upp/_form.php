<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Upp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Aretes asignados</div>
    <div class="panel-body">
<div class="upp-form">


    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'r01_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'r01_superficie')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'r01_clave')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'r01_localidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'r01_municipio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'r01_estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'r01_faretado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'r01_tenencia')->textInput(['maxlength' => true]) ?>-->



            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'label' => 'Arete',
                        'value' => function($data) {
                            return '<b>'.$data->r02_numero.'</b>';
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Fecha de nacimiento',
                        'value' => function($model) {
                            return DatePicker::widget([
    'name' => 'check_issue_date',
    'value' => date('d-M-Y', strtotime('+2 days')),
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
]);

                        },
                        'format' => 'raw'
                    ],

                    [
                        'label' => 'Sexo',
                        'value' => function($model) {
                            return Html::dropDownList('text', null,['Macho', 'Hembra'], ['class'=>'form-control']);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label'=>'Raza',
                        'value' => function($model) {
                            return Html::dropDownList('text', null,['Raza 1', 'Raza 2'], ['class'=>'form-control']);
                        },
                        'format' => 'raw'
                    ],

                    [
                        'label' => 'Cruza',
                        'value' => function($model) {
                            return Html::input('text', 'valor'.$model->r02_raza,null,['class'=>'form-control', 'id'=>'valor'.$model->r02_raza]);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Empadre',
                        'value' => function($model) {
                            return Html::input('text', 'valor'.$model->Empadre,null,['class'=>'form-control', 'id'=>'valor'.$model->Empadre]);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Foto',
                        'value' => function($data) {
                            return Html::fileInput(['required' => true]);
                    },
                        'format' => 'raw'
                    ],
                ],
            ]);
            ?><br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div></div>
</div>
