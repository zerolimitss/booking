<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 * Has foreign keys to the tables:
 *
 * - `rooms`
 */
class m180509_085529_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'number' => $this->string(),
            'checkIn' => $this->dateTime(),
            'checkOut' => $this->dateTime(),
            'time' => $this->dateTime(),
            'room_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `room_id`
        $this->createIndex(
            'idx-orders-room_id',
            'orders',
            'room_id'
        );

        // add foreign key for table `rooms`
        $this->addForeignKey(
            'fk-orders-room_id',
            'orders',
            'room_id',
            'rooms',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `rooms`
        $this->dropForeignKey(
            'fk-orders-room_id',
            'orders'
        );

        // drops index for column `room_id`
        $this->dropIndex(
            'idx-orders-room_id',
            'orders'
        );

        $this->dropTable('orders');
    }
}
