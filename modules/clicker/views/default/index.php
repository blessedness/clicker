<?php

use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \app\modules\clicker\entities\ClickSearch */

$this->title = 'Click logs';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="clicker-domain-index">
    <?php Pjax::begin([
        'timeout' => 6000,
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-bordered table-hover',
            'data' => [
                'logs' => ''
            ]
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'ua',
            'ip',
            'ref',
            'param1',
            'param2',
            'error',
            'bad_domain',
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>