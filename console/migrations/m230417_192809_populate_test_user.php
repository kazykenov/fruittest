<?php

use yii\db\Migration;

/**
 * Class m230417_192809_populate_test_user
 */
class m230417_192809_populate_test_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'id' => 1,
            'username' => 'test',
            'auth_key' => 'Xqql89BiCtpxsEqo_-5deq23VnImV2o4',
            'password_hash' => '$2y$13$JfVXxleaxKWQDMaB7LcmHuSXON2UnGnSyTmYq3JMKHlPDT2FD68Ri',
            'email' => 'test@test.test',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', [
            'id' => 1,
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230417_192809_populate_test_user cannot be reverted.\n";

        return false;
    }
    */
}
