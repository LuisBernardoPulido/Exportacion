<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Estados;
use app\models\LocalidadesZac;
use app\models\Municipios;

/* @var $this yii\web\View */
/* @var $model app\models\Ganaderos */

$this->title = $model->c01_nombre ." ".$model->c01_apaterno." ".$model->c01_amaterno ;
$this->params['breadcrumbs'][] = ['label' => 'Productores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Datos de registro</div>
    <div class="panel-body">
<div class="ganaderos-view"><br>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->c01_id], ['class' => 'btn btn-primary button_crear']) ?>
    </p>

    <?php
    if($model->c01_tipo==1){
        $attributes=[
            'c01_razonsocial',
            'c01_rfc',
            'c01_nombre',
            'c01_apaterno',
            'c01_amaterno',
            'c01_telefono',
            'c01_colonia',
            'c01_calle',
            'c01_cp',
            'c01_localidad',
            'c01_municipio',
            'c01_estado',
            'c01_correo',
        ];
    }else{
        $attributes=[

            'c01_nombre',
            'c01_apaterno',
            'c01_amaterno',
            'c01_telefono',
            'c01_colonia',
            'c01_calle',
            'c01_cp',
            'c01_curp',
            [
                'attribute'=>'c01_localidad',
                'value'=>function($model){
                    return LocalidadesZac::findOne($model->c01_localidad)?LocalidadesZac::findOne($model->c01_localidad)->c04_nom_loc:'';
                }
            ],
            [
                'attribute'=>'c01_municipio',
                'value'=>function($model){
                    return Municipios::findOne($model->c01_municipio)?Municipios::findOne($model->c01_municipio)->c03_nom_mun:'';
                }
            ],
            [
                'attribute'=>'c01_estado',
                'value'=>function($model){
                    return Estados::findOne($model->c01_estado)->c02_nom_ent;
                }
            ],
            'c01_correo',
        ];
    }



    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
    ]) ?>


    <div class="panel panel-info" id="unidades_por_productor" style="display: block">
        <div class="panel-heading" id="panel-info-header">Unidades de Producción Pecuaria</div>
        <div class="panel-body">
            <?php
            if($model->isNewRecord){
                $indicador=-1;
            }else{
                $indicador=$model->c01_id;
            }

            ?>

            <?php
            $script="$('#modalContent2').load(document.getElementById('modalButton').value);";
            $this->registerJs($script, \yii\web\View::POS_READY, 'unidades-ganadero');?>
            <div id ='modalContent2'></div>
            <!--<input type="hidden" id="modalButton"  value="index.php?r=ganaderos/add_unidad&indicador=<?=$indicador?>">-->

            <?php \yii\widgets\Pjax::begin([ 'id' => 'grid-productos']);?>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $relaciones,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label'=>'Clave',
                        'value'=>function($relaciones){
                            $model=\app\models\Upp::findOne($relaciones->r01_id);
                            return strtoupper($model->r01_clave);
                        },
                        'format' => 'raw'
                    ],

                    [
                        'label'=>'Nombre de Unidad',
                        'value'=>function($relaciones){
                            $model=\app\models\Upp::findOne($relaciones->r01_id);

                            return strtoupper($model->r01_nombre);

                        },
                        'format' => 'raw'
                    ],

                ],
            ]); ?>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>

    </div>


</div>
</div>
</div>
