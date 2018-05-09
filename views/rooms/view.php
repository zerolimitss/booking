<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Rooms */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rooms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute'=>'photo',
                'value'=>Html::img('/images/'.$model->photo,['width'=>300]),
                'format'=>'html'
            ],
            'info',
            [
                'attribute' => 'orders',
                'value' => call_user_func(function($data){
                    $s = '';
                    foreach ($data->orders as $order) {
                        $s .= Html::a($order->name,['rooms/booked', 'id'=>$order->id]) . "<br>";
                    }
                    return $s;
                },$model),
                'format' => 'raw'
            ],

        ],
    ]) ?>

</div>