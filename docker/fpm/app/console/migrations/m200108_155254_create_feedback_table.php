<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feedback`.
 */
class m200108_155254_create_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('feedback', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256),
            'phone' => $this->string(16)
                ->notNull(),
            'status' => $this->smallInteger()
                ->notNull()
                ->defaultValue(0)
                ->comment('0 - на модерации | 1 - модерация пройдена'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('feedback');
    }
}
