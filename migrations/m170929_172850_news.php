<?php

use yii\db\Migration;

class m170929_172850_news extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('news', 'date', $this->timestamp() . ' NOT NULL  DEFAULT CURRENT_TIMESTAMP');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170929_172850_news cannot be reverted.\n";

        return false;
    }
    */
}
