<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Номера';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'title',
                'value'=>function($model){
                    return Html::a($model->title, ['rooms/view', 'id'=>$model->id]);
                },
                'format' => 'html'
            ],
            [
                'attribute'=>'photo',
                'value'=>function($model){
                    return Html::img('/images/'.$model->photo,['width'=>100]);
                },
                'format' => 'html'
            ],
            //'info',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
