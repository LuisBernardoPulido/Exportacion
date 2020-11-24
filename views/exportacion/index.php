<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExportacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ingresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exportacion-index">
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'p11_id',
            'p11_guia',
            'p11_fecha',
            'r01_origen',
            'r01_destino',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
