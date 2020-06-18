<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PerfilUsuario */

$this->title = "Ver detalles de: ".$model->a02_nombre;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['list']];
$this->params['breadcrumbs'][] = $model->a02_nombre;
$this->beginBlock('content-header');
?>

<?php //$this->endBlock(); ?>

<div class="panel panel-primary" id="panel-primary-mpc">
    <div class="panel-heading" id="panel-heading-mpc">Detalles de <?=$model->a02_nombre?></div>
    <div class="panel-body">



<div class="perfil-usuario-view">
    <div class="buttonCont">
        <a href="<?= Url::toRoute(['update', 'id' => $model->a02_id]) ?>" class="textButtonEdit <?= Yii::$app->user->can('/perfilusuario/*')? "":(Yii::$app->user->can('/perfilusuario/update')?"":"hidden") ?>"><label src="" class="fa fa-pencil btn-edit"></label>
            Editar</a>
    </div>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'a02_id',
            //'a01_id',
            [
                'attribute'=>'a01_id',
                'value' => app\models\Users::findIdentityUser($model->a01_id)->username
            ],
            'a02_nombre',
            'a02_apaterno',
            'a02_amaterno',
            'a02_email:email',
            'a02_telfono',
            [
                'attribute'=>'a02_usuAlta',
                'value' =>'Pedro Loyola 544, Zona Centro',
            ],

            [
                'attribute'=>'a02_fecAlta',
                'value' => $model->a02_fecAlta,
            ],

            [
                'attribute'=>'a02_usuMod',
                'value' => !$model->a02_usuMod ? '': app\models\Users::findIdentity($model->a02_usuMod)->username
            ],
            [
                'attribute'=>'a02_fecMod',
                'value' => $model->a02_fecMod,
            ],
        ],
    ]) ?>

    <div class="panel panel-primary" id="panel-primary-mpc">
        <div class="panel-heading" id="panel-heading-mpc">Mis unidades</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Responsive Hover Table</h3>

                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Unidad</th>
                                    <th>Clave</th>
                                    <th>Estatus</th>
                                    <th>Municipio</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>EL CAPULIN</td>
                                    <td>14-019-0030-287</td>
                                    <td><span class="label label-success">Vigente</span></td>
                                    <td>Zacatecas</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Tilachetes, Toriles y Jomate</td>
                                    <td>14-031-1242-002</td>
                                    <td><span class="label label-success">Vigente</span></td>
                                    <td>Zacatecas.</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>El mezquital</td>
                                    <td>14-031-1242-003</td>
                                    <td><span class="label label-success">Vigente</span></td>
                                    <td>Zacatecas</td>
                                </tr>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
</div>


    </div>
</div>

