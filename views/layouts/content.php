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
    <strong>Copyright &copy; 2020 <a href="http://www.mpcdemexico.com.mx">Systech Software</a>.</strong> Todos los derechos reservados.
</footer>
<div class='control-sidebar-bg'></div>