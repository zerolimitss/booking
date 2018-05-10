<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Система бронирования номеров';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Список номеров</h2>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'title',
                'value'=>$model->title,
                'format' => 'html'
            ],
            [
                'attribute'=>'photo',
                'value'=>function($model){
                    return Html::img('/images/'.$model->photo,['width'=>100]);
                },
                'format' => 'html'
            ],
            'info',
            [
                'value'=>function($model){
                    return Html::a("Забронировать", ['site/book', 'id'=>$model->id]);
                },
                'format' => 'html'
            ]
        ],
    ]); ?>
</div>
