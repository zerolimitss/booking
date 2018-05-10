<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property int $id
 * @property string $title
 * @property string $photo
 *
 * @property Orders[] $orders
 */
class Rooms extends \yii\db\ActiveRecord
{
    public $name;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'info'], 'string', 'max' => 255],
            ['photo', 'file', 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'photo' => 'Фото',
            'info' => 'Краткое описание',
            'orders' => 'Список броней по номеру',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['room_id' => 'id']);
    }

    /*public function getOrdersCount()
    {
        return $this->hasMany(Orders::className(), ['room_id' => 'id'])->count();
    }*/
}
