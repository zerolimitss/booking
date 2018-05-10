<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $name
 * @property string $number
 * @property string $day
 * @property string $time
 * @property int $room_id
 *
 * @property Rooms $room
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day', 'time'], 'safe'],
            [['room_id'], 'required'],
            [['room_id'], 'integer'],
            [['name', 'number'], 'string', 'max' => 255],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя клиента',
            'number' => 'Телефон',
            'day' => 'День, на который бронируется',
            'time' => 'Время бронирования',
            'room_id' => 'Номер',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Rooms::className(), ['id' => 'room_id']);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->day = date("d-m-Y", strtotime($this->day));
        $this->time = date("h:i d-m-Y", strtotime($this->time));
    }
}
