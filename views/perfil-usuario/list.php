<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Lista Usuarios</div>
    <div class="panel-body">
        <div class="usuarios-view">
            <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'a02_id',
                    //'a01_id',
                    [
                        'attribute'=>'a01_id',
                        'value' =>'usuario.username',
                        'filter'=>  \kartik\widgets\Select2::widget([
                            'model'=> $searchModel,
                            'attribute'=>'a01_id',
                            'data' => \app\models\PerfilUsuario::getAll(),
                            'options' => ['placeholder' => 'Seleccionar usuario..'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]),
                    ],
                    'a02_nombre',
                    'a02_apaterno',
                    'a02_amaterno',
                    //'a02_email',
                    [
                        'attribute'=>'a02_activo',
                        'value' => function($model){
                            if($model->a02_activo==1)
                                return '<font color="#228b22n">ACTIVO</font>';
                            else
                                return '<font color="red">INACTIVO</font>';
                        },
                        'filter'=>['0'=>'INACTIVO','1'=>'ACTIVO'],
                        'format'=>'raw',
                    ],

                    [
                        'attribute' => '',
                        'format' => 'raw',
                        'contentOptions'=>[
                            "align"=>'center',
                            // "width"=>"8%",
                        ],
                        'value' => function($model){

                            $ver='<a href="index.php?r=perfil-usuario/view&id='.$model->a02_id.'" title="Ver" aria-label="Ver" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>';

                            if($model->a02_ismed==1){
                                $medico = \app\models\Medicos::find()->where('user_id=:id',[':id'=>$model->a02_id])->one();
                                if($medico) {
                                    $editar = '<a href="index.php?r=medicos/update&id=' . $medico->c05_id . '" title="Editar" aria-label="Editar" data-pjax="0"><span class="glyphicon glyphicon-user"></span></a>';
                                    $asignacion= " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                }else{
                                    $editar='<a href="index.php?r=perfil-usuario/update&id='.$model->a02_id.'" title="Editar" aria-label="Editar" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';
                                    $asignacion='<a href="index.php?r=/admin/assignment/view&id='.$model->a02_id.'" title="Asignación" aria-label="Asignación" data-pjax="0"><span class="glyphicon glyphicon-pushpin"></span></a>';
                                }
                                $eliminar = " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            }else{
                                $editar='<a href="index.php?r=perfil-usuario/update&id='.$model->a02_id.'" title="Editar" aria-label="Editar" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';
                                $asignacion='<a href="index.php?r=/admin/assignment/view&id='.$model->a02_id.'" title="Asignación" aria-label="Asignación" data-pjax="0"><span class="glyphicon glyphicon-pushpin"></span></a>';
                                $eliminar='<a href="'.\yii\helpers\Url::toRoute(['delete','id'=>$model->a02_id]).'" title="Eliminar" aria-label="Eliminar" data-confirm="¿Está seguro de eliminar este elemento?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>';
                            }

                            return $ver.' '.$editar.' '.$asignacion.' '.$eliminar;
                        },
                        'contentOptions'=>[
                            "align"=>'center',
                            "width"=>'10%',
                        ],
                    ],
                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>


