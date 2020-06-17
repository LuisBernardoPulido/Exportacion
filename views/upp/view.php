<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_upps.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $model app\models\Upp */

$this->title = $model->r01_clave;
$this->params['breadcrumbs'][] = ['label' => 'UPP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Datos de Unidad de Producción Pecuaria</div>
    <div class="panel-body">
<div class="upp-view">
<br>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'r01_id',
            'r01_nombre',
            'r01_superficie',
            'r01_clave',
            'r01_localidad',
            'r01_municipio',
            'r01_estado',
            'r01_faretado',
            'r01_tenencia',
        ],
    ]) ?>

    <div class="panel panel-default">
        <div class="panel-heading">Aretes asignados</div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'label' => 'Arete',
                        'value' => function($data) {
                            return $data->r02_numero;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Fecha de nacimiento',
                        'value' => function($data) {
                            return $data->r02_fnacimiento;
                        },
                        'format' => 'raw'
                    ],

                    [
                        'label' => 'Sexo',
                        'value' => function($data) {
                            return $data->r02_sexo;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Raza',
                        'value' => function($data) {
                            return $data->r02_raza;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Cruza',
                        'value' => function($data) {
                            return $data->r02_raza;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Empadre',
                        'value' => function($data) {
                            return $data->Empadre;
                        },
                        'format' => 'raw'
                    ],
                    [
                        'label' => 'Foto',
                        'value' => function($data) {
                            return "<a style='color: #0d6aad' href='#' onclick='show()'><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></a>";
                        },
                        'format' => 'raw'
                    ],

                ],
            ]);
            ?>
        </div>
    </div>

</div>
    </div></div>
