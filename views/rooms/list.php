<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список забронированных номеров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'room_id',
                'value'=> function($model){
                    return Html::a($model->room->title, ['rooms/view', 'id'=>$model->room->id]);
                },
                'format'=>'html'

            ],
            'name',
            'number',
            'checkIn',
            'checkOut',
            'time',
            //'info',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
