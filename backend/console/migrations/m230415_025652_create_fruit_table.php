<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fruit}}`.
 */
class m230415_025652_create_fruit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fruit}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'family' => $this->string(),
            'nutritions' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fruit}}');
    }
}
