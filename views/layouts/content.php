<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
$this->registerCssFile('css/style_mpc.css');
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/control_confaxis.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="content-wrapper">
    <section class="content-header" style="margin-top: 50px;">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; 2019 <a href="http://www.mpcdemexico.com.mx">Systech Software</a>.</strong> Todos los derechos reservados.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">

    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Actividad Reciente</h3>
            <ul class='control-sidebar-menu'>
               <!-- <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>-->
            </ul>



        </div>



        <div class="tab-pane active" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">Configuración de Reporte</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">

                    </label>

                    <p>
                        Utiliza los comandos inferiores para configurar los margenes de impresión de acuerdo a las caracteristicas de tu dispositivo.
                    </p>
                </div>


                <div class="form-group">
                    <!--<label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked/>
                    </label>

                    <p>
                        Other sets of options are available
                    </p>-->
                    <!--
                    <br><br>
                    <div class="contenido_arrows">
                        <a href="#"><div class="up-arrow">Arriba</div></a>
                        <br><br><br>
                        <div class="left-arrow">Derecha</div>
                        <br><br><br>
                        <div class="down-arrow">Abajo</div>
                    </div>-->

                    <!--
                      <p align="center">
                        <a href="#"><i class="remove glyphicon glyphicon-triangle-top glyphicon-white iconos"></i></a>
                    </p>
                    <p align="center">
                        <a href="#"><i class="remove glyphicon glyphicon-triangle-left glyphicon-white iconos" style="margin-right: 25px"></i></a>
                        <a href="#"><i class="remove glyphicon glyphicon-triangle-right glyphicon-white iconos" style="margin-left: 25px"></i></a>
                    </p>
                    <p align="center">
                        <a href="#"><i class="remove glyphicon glyphicon-triangle-bottom glyphicon-white iconos"></i></a>
                    </p>
                    -->
                    <p align="center">
                        <a href="#" onclick="mover_configuracion(0)"><i class="remove glyphicon glyphicon-triangle-top glyphicon-white iconos"></i></a>
                    </p>
                    <p align="center">
                        <a href="#" onclick="mover_configuracion(1)"><i class="remove glyphicon glyphicon-triangle-left glyphicon-white iconos" style="margin-right: 27px"></i></a>
                        <a href="#" onclick="mover_configuracion(2)"><i class="remove glyphicon glyphicon-triangle-right glyphicon-white iconos" style="margin-left: 27px"></i></a>
                    </p>
                    <p align="center">
                        <a href="#" onclick="mover_configuracion(3)"><i class="remove glyphicon glyphicon-triangle-bottom glyphicon-white iconos"></i></a>
                    </p>

                </div>

                <h3 class="control-sidebar-heading">Preguntas frecuentes</h3>
                <div class="form-group">
                <p>
                    <a target="_blank" href="https://chrome.google.com/webstore/detail/ignore-x-frame-options/dibpjejofkkejnndlfjokflmnkekjkpn" style="color: #b8c7ce">1. Tengo problemas al visualizar los reportes.</a>

                </p>

                <p>

                    <a href="index.php?r=site/contact" style="color: #b8c7ce">2. Aparecen pruebas ajenas a mi cuenta de usuario.</a>
                </p>
                </div>

            </form>
        </div>
   
    </div>
</aside>--><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>