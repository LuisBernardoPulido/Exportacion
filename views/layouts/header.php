<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->request->baseUrl.'/sweetalert2/sweetalert2.min.js', ['depends'=>[\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->request->baseUrl.'/sweetalert2/sweetalert2.css');
$this->registerJsFile(Yii::$app->request->baseUrl.'/bootstrap-select-1.12.2/bootstrap-select.js', ['depends'=>[\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/bootstrap-select-1.12.2/bootstrap-select.js', ['depends'=>[\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/vendor/igorescobar/jquery-mask-plugin/src/jquery.mask.js', ['depends'=>[\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('/SIFOPE/kartik-v/yii2-widget-select2/assets/js/select2.full.js', ['depends'=>[\yii\web\JqueryAsset::className()]]);
//$values = $headers->remove('X-Frame-Options');
/* @var $this \yii\web\View */
/* @var $content string */

?>


<header class="main-header" style="position: fixed;width: 100%;" xmlns="http://www.w3.org/1999/html">

    <?= Html::a('<span class="logo-mini">SF</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown notifications-menu">
                    <?php
                        if(\app\models\User::isUserAdmin(Yii::$app->user->getId())){
                            $alertas = \app\models\Brucelosis::find()->where('p03_rv is not null')
                                ->orWhere('p03_fj is not null')->andWhere('p03_isdictaminado!=1');

                            $alertas_tb =  \app\models\Tuberculosis::find()->where('p03_cc is not null')
                            ->andWhere('p03_isdictaminado!=1');

                            $count = $alertas->count()+$alertas_tb->count();
                        }else if(\app\models\User::isUserMedico(Yii::$app->user->getId())){
                            $medico = \app\models\Medicos::find()->where('user_id=:id', [':id'=>Yii::$app->user->getId()])->one();

                            $alertas = \app\models\Brucelosis::find()->where('p03_rv is not null')
                                ->orWhere('p03_fj is not null')->andWhere('p03_isdictaminado!=1')->andWhere('c05_id=:id', [':id'=>$medico->c05_id]);

                            $alertas_tb =  \app\models\Tuberculosis::find()->where('p03_cc is not null')
                                ->andWhere('p03_isdictaminado!=1')->andWhere('c05_id=:id', [':id'=>$medico->c05_id]);

                            $count = $alertas->count()+$alertas_tb->count();
                        }else if(\app\models\User::isUserLab(Yii::$app->user->getId())){
                            $alertas = \app\models\Brucelosis::find()->where('p03_rv is not null')
                                ->andWhere('p03_isdictaminado!=1')->andWhere('p03_laboratorio=:id', [':id'=>Yii::$app->user->getId()]);

                            $alertas_tb =  \app\models\Tuberculosis::find()->where('p03_cc is not null')
                                ->andWhere('p03_isdictaminado=3');

                            $count = $alertas->count()+$alertas_tb->count();

                        }else{
                            $alertas = \app\models\Brucelosis::find()->where('p03_rv is not null')
                                ->orWhere('p03_fj is not null')->andWhere('p03_isdictaminado!=1');

                            $alertas_tb =  \app\models\Tuberculosis::find()->where('p03_cc is not null')
                                ->andWhere('p03_isdictaminado!=1');

                            $count = $alertas->count()+$alertas_tb->count();
                        }
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <?='<span class="label alert-warning">' . $count . '</span>'?>
                        <!--<span class="label label-warning">4</span>-->
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><?=$count==1 ? 'Tienes 1 notificación' : 'Tienes '.$count.' notificaciones'?></li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <?php
                                foreach ($alertas->all() as $model) {
                                    $color="red";
                                        //$color="#30ca30";
                                        //$color="#e8e829";
                                        //$color="red";
                                    ?>
                                    <li>
                                        <a href="<?=\yii\helpers\Url::toRoute(['brucelosis/view','id'=>$model->p03_id])?>">
                                            <i class="fa fa-warning" style="color: <?=$color?>;"></i> <?='Tienes un dictamen de BR con positivos'?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <?php
                                foreach ($alertas_tb->all() as $model) {
                                    $color="#e8e829";
                                    //$color="#30ca30";
                                    //$color="#e8e829";
                                    //$color="red";
                                    ?>
                                    <li>
                                        <a href="<?=\yii\helpers\Url::toRoute(['tuberculosis/view','id'=>$model->p03_id])?>">
                                            <i class="fa fa-warning" style="color: <?=$color?>;"></i> <?='Tienes un dictamen de TB para cervical'?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>

                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user.png" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"> <?=\app\models\PerfilUsuario::find()->where('a01_id=:user', [':user'=>Yii::$app->user->getId()])->one()->a02_nombre?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" id="color_header">
                            <img src="<?= $directoryAsset ?>/img/user.png" class="img-circle"
                                 alt="User Image"/>
                            <h4><font color="white"<p><b>Bienvenido</b></p></h4></font>

                            <p>
                                <?=\app\models\PerfilUsuario::find()->where('a01_id=:user', [':user'=>Yii::$app->user->getId()])->one()->a02_nombre?>
                                <?=\app\models\PerfilUsuario::find()->where('a01_id=:user', [':user'=>Yii::$app->user->getId()])->one()->a02_apaterno?>
                            </p>
                        </li>
                        <!-- Menu Body
                        <li class="user-body">

                        </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= Url::toRoute(["/perfil-usuario/update","id" => \app\models\PerfilUsuario::find()->where('a01_id=:user', [':user'=>Yii::$app->user->getId()])->one()->a01_id])?>" class="btn btn-default btn-flat">Mi perfil</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Salir',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <?php
                if((Yii::$app->controller->action->controller->uniqueId=='seleccion-previa' && Yii::$app->controller->action->id=='campo') ||(Yii::$app->controller->action->controller->uniqueId=='brucelosis' && Yii::$app->controller->action->id=='imprimir') || (Yii::$app->controller->action->controller->uniqueId=='tuberculosis' && Yii::$app->controller->action->id=='imprimir') || (Yii::$app->controller->action->controller->uniqueId=='vacunacion' && Yii::$app->controller->action->id=='imprimir')){
                ?>
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                <?php
                }

                ?>

            </ul>
        </div>
    </nav>
</header>

