<?php

/* @var $this yii\web\View */
use yii\widgets\Menu;
$this->registerCssFile('css/style_mpc.css');

$this->title=''
?>



<!-- Main content -->
<section class="invoice">

    <!-- title row -->
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-8">
            <h1 class="page-header" style="text-align: center;">
                <i class="fa fa-home"></i>
                Bienvenido(a) <?=ucwords($medico->c05_nombre).' '.ucwords($medico->c05_apaterno).' '.ucwords($medico->c05_amaterno)?>

            </h1>
        </div>
        <div class="col-xs-2"><small class="pull-right"><?=date('d/m/Y');?></small></div>

        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p align="justify" style="margin-left: 60px;margin-right: 60px; margin-bottom: 30px;margin-top: 20px;">
                SIFOPE es un sistema de control de ganado desarrollado por Systech Software con el fin de proporcionar una herramienta útil y ademas práctica para que tu trabajo sea mucho más sencillo y satisfactorio. Te invitamos a consultar nuestro manual de usuario dando click en el siguiete enlace <a href="#">Aqui</a>, donde podrás encontrar toda la información relacionada al correcto uso de esta innovadora herramienta.

        </p>
        </div>
    </div>
    <!-- info row -->

    <div class="raw">
        <div class="col-xs-12">
            <h2 style="text-align: center; margin-bottom: 30px">Pendientes</h2>
        </div>
    </div>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?=
                        \app\models\AsignacionMedico::find()
                        ->where('c05_id=:id', [':id'=>$medico->c05_id])
                        ->andWhere('r03_tipo=:tipo',[':tipo'=>'R'])->count();
                        ?></h3>

                    <p>Reseñas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-address-card-o"></i>
                </div>
                <a href="<?=\yii\helpers\Url::toRoute(['/dictamen-medico', 'tipo' => 'R'])?>" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?=
                        \app\models\AsignacionMedico::find()
                            ->where('c05_id=:id', [':id'=>$medico->c05_id])
                            ->andWhere('r03_tipo=:tipo',[':tipo'=>'B'])->count();
                        ?></h3>

                    <p>Brucelosis</p>
                </div>
                <div class="icon">
                    <i class="fa fa-eyedropper"></i>
                </div>
                <a href="<?=\yii\helpers\Url::toRoute(['/dictamen-medico', 'tipo' => 'B'])?>" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?=
                        \app\models\AsignacionMedico::find()
                            ->where('c05_id=:id', [':id'=>$medico->c05_id])
                            ->andWhere('r03_tipo=:tipo',[':tipo'=>'T'])->count();
                        ?></h3>

                    <p>Tubercolisis</p>
                </div>
                <div class="icon">
                    <i class="fa fa-eyedropper"></i>
                </div>
                <a href="<?=\yii\helpers\Url::toRoute(['/dictamen-medico', 'tipo' => 'T'])?>" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>0</h3>

                    <p>Aretes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-paw"></i>
                </div>
                <a href="#" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>Admin, Inc.</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Phone: (804) 123-5432<br>
                Email: info@almasaeedstudio.com
            </address>
        </div>

        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong>John Doe</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Phone: (555) 539-1037<br>
                Email: john.doe@example.com
            </address>
        </div>

        <div class="col-sm-4 invoice-col">
            <b>Invoice #007612</b><br>
            <br>
            <b>Order ID:</b> 4F3S8J<br>
            <b>Payment Due:</b> 2/22/2014<br>
            <b>Account:</b> 968-34567
        </div>

    </div>-->

</section>