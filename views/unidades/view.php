<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\LocalidadesZac;
use app\models\Municipios;
use app\models\Estados;
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_del_grid.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_modal.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $model app\models\Upp */

$this->title = 'UPP: '. $model->r01_clave;
$this->params['breadcrumbs'][] = ['label' => 'Unidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Datos de Unidad de Producción Pecuaria</div>
    <div class="panel-body">
<div class="upp-view">

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->r01_id], ['class' => 'btn btn-primary button_crear']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'r01_id',
            'r01_nombre',
            'r01_superficie',
            'r01_clave',
            [
                'attribute'=>'r01_localidad',
                'value'=>function($model){
                    return LocalidadesZac::findOne($model->r01_localidad)?LocalidadesZac::findOne($model->r01_localidad)->c04_nom_loc:'';
                }
            ],
            [
                'attribute'=>'r01_municipio',
                'value'=>function($model){
                    return Municipios::findOne($model->r01_municipio)?Municipios::findOne($model->r01_municipio)->c03_nom_mun:'';
                }
            ],
            [
                'attribute'=>'r01_estado',
                'value'=>function($model){
                    return Estados::findOne($model->r01_estado)?Estados::findOne($model->r01_estado)->c02_nom_ent:'';
                }
            ],
            //'r01_faretado',
            [
                    'attribute'=>'r01_tenencia',
                    'value'=>function($data){
                        return $data->r01_tenencia?\app\models\Tenencias::findOne($data->r01_tenencia)->c10_descrip:'';
                    }
            ],
            //'r01_mostrar',
            'r01_usuAlta',
            'r01_fecAlta',
            'r01_usuMod',
            'r01_fecMod',
        ],
    ]) ?>

</div>
        <?php
        $indicador=$model->r01_id;
        ?>
        <div class="panel panel-info" id="panel-info-tb" >
            <div class="panel-heading" id="panel-info-header">Propietarios</div>
            <div class="panel-body">

               <!-- <input type="hidden" id="modalButton"  value="index.php?r=unidades/add_productor&indicador=<?=$indicador?>">-->
                <?php \yii\widgets\Pjax::begin([ 'id' => 'grid-productos']);
                $script="$('#modalContent2').load(document.getElementById('modalButton').value);";
                $this->registerJs($script, \yii\web\View::POS_READY, 'productos-avisos');?>
                <div id ='modalContent2'></div>

                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $relaciones,
                   // 'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

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

                    ],
                ]); ?>
                <?php \yii\widgets\Pjax::end(); ?>
            </div>
        </div>

    </div>
</div>