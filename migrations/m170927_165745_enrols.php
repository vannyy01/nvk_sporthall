<?php

use yii\db\Migration;

class m170927_165745_enrols extends Migration
{
    public function up()
    {
        $this->createTable("enroll", [
            'id' => $this->primaryKey(),
            'name' => $this->string(32),
            'second_name' => $this->string(32),
            'time' => $this->dateTime()->notNull(),
            'email' => $this->string(50)->notNull(),
            'phone' => $this->string(20)->notNull(),
        ]);

        $this->alterColumn('enroll', 'id', $this->smallInteger(8)->unsigned()->unique() . ' NOT NULL AUTO_INCREMENT');

        $this->insert('enroll', [
            'name' => 'Іван',
            'second_name' => 'Кравченко',
            'time' => '2017-09-26 16:00:00',
            'email' => 'vanny2@mgd.v',
            'phone' => '+380402414132'
        ]);

        $this->insert('enroll', [
            'name' => 'Сергій',
            'second_name' => 'Шкребтан',
            'time' => '2017-09-26 16:00:00',
            'email' => 'serg@ff.v',
            'phone' => '+380402414342'
        ]);
        $this->insert('enroll', [
            'name' => 'Оля',
            'second_name' => 'Суббота',
            'time' => '2017-09-26 16:00:00',
            'email' => 'ol2@msd.v',
            'phone' => '+380234514132'
        ]);
        $this->addForeignKey(
            'fk-affairs-enroll_id',
            'enroll',
            'time',
            'affairs',
            'time',
            'CASCADE'
        );
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170927_165745_enrols cannot be reverted.\n";

        return false;
    }
    */
}
