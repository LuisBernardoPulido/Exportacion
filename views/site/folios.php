<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\View;
use app\models\Utileria;

$this->title = 'Consulta de folios';
$this->params['breadcrumbs'][] = $this->title;

switch ($isin){
    case 1: $title = "Brucelosis";
            $dictamen = \app\models\Brucelosis::findOne($id);
            $link = "index.php?r=brucelosis/view&id=".$id;
    break;
    case 2: $title = "Tuberculosis";
        $dictamen = \app\models\Tuberculosis::findOne($id);
        $link = "index.php?r=tuberculosis/view&id=".$id;
        break;
    case 3: $title = "Vacunación";
        $dictamen = \app\models\Vacunacion::findOne($id);
        $link = "index.php?r=vacunacion/view&id=".$id;
        break;
    case 4: $title = "Folio desechado";
        break;
}
?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Folios</div>
    <div class="panel-body">
        <div class="folios-index">
            <?php
            if($tipo==0){
                ?>
                <h4>Información de folio</h4>
                <?= \yii\widgets\DetailView::widget([
                    'model' => new \app\models\Folios(),
                    'attributes' => [
                        [
                            'label'=>'Estatus',
                            'value'=>'Existente'
                        ],
                        [
                            'label'=>'Asignado en',
                            'value'=>$title,
                        ],

                    ],
                ]) ?>
                <?php
                if($isin!=4){
                    ?>
                    <h4>Datos de dictamen</h4>
                    <?= \yii\widgets\DetailView::widget([
                        'model' => $dictamen,
                        'attributes' => [
                            [
                                'label'=>'Unidad de Producción Pecuaria',
                                'value'=>function($data){
                                    return \app\models\Upp::findOne($data->r01_id)->r01_clave.' - '.\app\models\Upp::findOne($data->r01_id)->r01_nombre;
                                }
                            ],
                            [
                                'label'=>'Estatus de dictamen',
                                'value'=>function($data){
                                    return $data->p03_isdictaminado==1?'Dictaminado':"No dictaminado";
                                },
                            ],
                            [
                                'label'=>'Fecha de alta',
                                'value'=>function($data){
                                    return $data->p03_fecAlta;
                                },
                            ],
                            [
                                'label'=>'Ver Dictamen',
                                'value'=>'<a href="'.$link.'">Ver más</a>',
                                'format'=>'raw'
                            ],

                        ],
                    ]) ?>
                    <?php

                }
                ?>

            <?php

            }else if($tipo==1){
                ?>
                <h4>Folios Asignados a UPP <b><?=\app\models\Upp::findOne($upp)->r01_clave?></b></h4>
                <br>
            <div class="panel panel-info" id="panel-info-mpc">
                <div class="panel-heading" id="panel-info-header">Tuberculosis</div>
                <div class="panel-body">
                    <?= \yii\grid\GridView::widget([
                        'dataProvider' => \app\models\Folios::getTBPorUnidad($upp),
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'p03_folio',
                            [
                                    'attribute'=>'c05_id',
                                    'value'=>function($data){
                                        return \app\models\Medicos::findOne($data->c05_id)->c05_nombre.' '.\app\models\Medicos::findOne($data->c05_id)->c05_apaterno.' '.\app\models\Medicos::findOne($data->c05_id)->c05_amaterno;
                                    }
                            ],

                                    'p03_finyeccion',
                                    'p03_flectura',





                        ],
                    ]); ?>
                </div>
            </div>
                <div class="panel panel-info" id="panel-info-mpc">
                    <div class="panel-heading" id="panel-info-header">Brucelosis</div>
                    <div class="panel-body">
                        <?= \yii\grid\GridView::widget([
                            'dataProvider' => \app\models\Folios::getBRPorUnidad($upp),
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'p03_folio',
                                [
                                    'attribute'=>'c05_id',
                                    'value'=>function($data){
                                        return \app\models\Medicos::findOne($data->c05_id)->c05_nombre.' '.\app\models\Medicos::findOne($data->c05_id)->c05_apaterno.' '.\app\models\Medicos::findOne($data->c05_id)->c05_amaterno;
                                    }
                                ],

                                'p03_frealizacion',
                                'p03_fmuestreo',
                            ],
                        ]); ?>
                    </div>
                </div>
                <div class="panel panel-info" id="panel-info-mpc">
                    <div class="panel-heading" id="panel-info-header">Vacunación</div>
                    <div class="panel-body">
                        <?= \yii\grid\GridView::widget([
                            'dataProvider' => \app\models\Folios::getVCPorUnidad($upp),
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'p03_folio',
                                [
                                    'attribute'=>'c05_id',
                                    'value'=>function($data){
                                        return \app\models\Medicos::findOne($data->c05_id)->c05_nombre.' '.\app\models\Medicos::findOne($data->c05_id)->c05_apaterno.' '.\app\models\Medicos::findOne($data->c05_id)->c05_amaterno;
                                    }
                                ],

                                'p03_fexpedicion',

                            ],
                        ]); ?>
                    </div>
                </div>

            <?php
            }
            ?>
            <br>
            <a href='index.php?r=site/reportes'
               role="button"><?= Html::button('Regresar', ['class' => 'btn btn-primary button_crear', 'title' => "Regresar"]) ?></a>
<br>
<br>
        </div>
    </div>
</div>
