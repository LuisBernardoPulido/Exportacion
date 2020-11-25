<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SolicitudesExportacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Solicitudes Exportaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitudes-exportaciones-index">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'p12_sexo',
            'p12_aux',
            'p12_aux2',
            'p12_usuAlta',
            // 'p12_fecAlta',
            // 'p12_usuMod',
            // 'p12_fecMod',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
