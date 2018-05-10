<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * BookingForm is the model behind the booking form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class BookingForm extends Model
{
    public $name;
    public $number;
    public $startPeriod;
    public $endPeriod;
    public $room_id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'number', 'startPeriod', 'endPeriod'], 'required'],
            [['room_id'], 'safe'],
            [['startPeriod', 'endPeriod'], 'date','format' => 'php:Y-m-d'],
        ];
    }

    public function book()
    {
        if ($this->startPeriod < date("Y-m-d")) {
            $this->addError('startPeriod', 'Incorrect date.');
            return false;
        }
        if ($this->startPeriod > $this->endPeriod || $this->startPeriod == $this->endPeriod) {
            $this->addError('endPeriod', 'Incorrect date.');
            return false;
        }
        $available = Orders::find()->where("
            (checkIn BETWEEN '{$this->startPeriod} 12:00:00' AND '{$this->endPeriod} 12:00:00') OR 
            (checkOut BETWEEN '{$this->startPeriod} 12:00:00' AND '{$this->endPeriod} 11:59:59') OR 
            (checkIn <= '{$this->startPeriod}  12:00:00' AND checkOut >= '{$this->endPeriod} 11:59:59')
        ")->all();

        if(count($available) > 0){
            Yii::$app->session->setFlash('error', 'Room is not available on this date');
            return false;
        }

        if ($this->validate()) {
            $model = new Orders();
            $model->name = $this->name;
            $model->number = $this->number;
            $model->checkIn = $this->startPeriod . " 12:00:00";
            $model->checkOut = $this->endPeriod . " 11:59:59";
            $model->room_id = $this->room_id;
            $model->save();
            Yii::$app->session->setFlash('success', 'Room has been booked');
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'number' => 'Телефон',
            'bookingPeriod' => 'Период бронирования',
        ];
    }
}
