<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->request->baseUrl.'/sweetalert2/sweetalert2.min.js', ['depends'=>[\yii\web\JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->request->baseUrl.'/sweetalert2/sweetalert2.css');
$this->registerJsFile(Yii::$app->request->baseUrl.'/bootstrap-select-1.12.2/bootstrap-select.js', ['depends'=>[\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl.'/bootstrap-select-1.12.2/bootstrap-select.js', ['depends'=>[\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/vendor/igorescobar/jquery-mask-plugin/src/jquery.mask.js', ['depends'=>[\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
/* @var $this \yii\web\View */
/* @var $content string */

?>
<header class="main-header" style="position: fixed;width: 100%;" xmlns="http://www.w3.org/1999/html">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand"><b>Exportación</b></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="../web/index.php">Inicio <span class="sr-only">(current)</span></a></li>
                    <li><a href="../web/index.php?r=perfil-usuario%2Fview&id=1">Perfil</a></li>
                    <li><a href="../web/index.php?r=exportacion/create">Ingresar ganado</a></li>
                    <li><a href="../web/index.php?r=solicitudes-exportaciones/create">Generar solicitud</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Mis solicitudes</a></li>
                            <li><a href="#">Mis unidades</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Reportes</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">
                                <?=\app\models\PerfilUsuario::find()->where('a01_id=:user', [':user'=>Yii::$app->user->getId()])->one()->a02_nombre?>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">

                                <p>
                                    <?=\app\models\PerfilUsuario::find()->where('a01_id=:user', [':user'=>Yii::$app->user->getId()])->one()->a02_nombre?>
                                    <?=\app\models\PerfilUsuario::find()->where('a01_id=:user', [':user'=>Yii::$app->user->getId()])->one()->a02_apaterno?>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Solicitudes</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Reportes</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Contacto</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Mi perfil</a>
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
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>