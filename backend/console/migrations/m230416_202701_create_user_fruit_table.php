<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_fruit}}`.
 */
class m230416_202701_create_user_fruit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_fruit}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'fruit_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp(),
        ]);

        $this->addForeignKey('fk-user_fruit-2-user', 'user_fruit', 'user_id', 'user', 'id');
        $this->addForeignKey('fk-user_fruit-2-fruit', 'user_fruit', 'fruit_id', 'fruit', 'id');

        $this->createIndex('unique_user_fruit', 'user_fruit', ['user_id', 'fruit_id'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('unique_user_fruit', 'user_fruit');

        $this->dropForeignKey('fk-user_fruit-2-fruit', 'user_fruit');
        $this->dropForeignKey('fk-user_fruit-2-user', 'user_fruit');

        $this->dropTable('{{%user_fruit}}');
    }
}
