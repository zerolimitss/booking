<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rooms`.
 */
class m180509_084739_create_rooms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rooms', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'photo' => $this->string(),
            'info' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rooms');
    }
}
