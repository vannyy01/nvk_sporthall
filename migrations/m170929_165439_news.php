<?php

use yii\db\Migration;

class m170929_165440_news2 extends Migration
{
    public function up()
    {

        $this->createTable("news", [
            'id' => $this->primaryKey(),
            'header' => $this->string(100),
            'date' => $this->timestamp()->notNull(),
            'short_description' => $this->string(255),
            'full_description' => $this->text(),
            'author' => $this->string(32)->notNull(),
        ]);

        $this->alterColumn('news', 'id', $this->smallInteger(8)->unsigned()->unique() . ' NOT NULL AUTO_INCREMENT');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170929_165439_news cannot be reverted.\n";

        return false;
    }
    */
}
