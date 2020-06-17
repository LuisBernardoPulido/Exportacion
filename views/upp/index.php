<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UppSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'UPP Asginadas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upp-index" style="overflow-y: auto">
    <br>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'r01_clave',
            //'r01_id',
            'r01_nombre',
            //'r01_superficie',
            'r01_localidad',
            // 'r01_municipio',
            // 'r01_estado',
            'r01_faretado',
            // 'r01_tenencia',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'attribute' => 'Acción',
                'format' => 'raw',
                'contentOptions'=>[
                    "align"=>'center',
                    // "width"=>"8%",
                ],
                'value' => function($model){

                    $ver='<a href="index.php?r=upp/view&id='.$model->r01_id.'" title="Ver" aria-label="Ver" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>';
                    $editar='<a href="index.php?r=upp/update&id='.$model->r01_id.'" title="Editar" aria-label="Editar" data-pjax="0"><span class="glyphicon glyphicon-check"></span></a>';
                    $imprimir='<a href="'.\app\models\Utileria::generarUrlReporte('test', 'pdf', null).'" title="Descargar" aria-label="Editar" data-pjax="0" download><span class="glyphicon glyphicon-download-alt"></span></a>';

                    return $ver.' '.$editar.' '.$imprimir;
                },
                'contentOptions'=>[
                    "align"=>'center',
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

