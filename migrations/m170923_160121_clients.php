<?php

use yii\db\Migration;

class m170923_160121_clients extends Migration
{public function up()
{
    $this->createTable("affairs", [
        'id' => $this->primaryKey(),
        'time' => $this->dateTime()->unique(),
        'clients' => $this->smallInteger(4)->defaultValue(0),
        'trainer' => $this->string(32),
    ]);

    $this->alterColumn('affairs', 'id', $this->smallInteger(8)->unsigned()->unique() . ' NOT NULL AUTO_INCREMENT');


    $this->insert('affairs', [
        'time' => '2017-09-26 16:00:00',
        'clients' => 6,
        'trainer' => 'Шкребтан С.О'
    ]);

    $this->insert('affairs', [
        'time' => '2017-09-28 16:00:00',
        'clients' => 3,
        'trainer' => 'Шкребтан С.О'
    ]);
    $this->insert('affairs', [
        'time' => '2017-10-20 18:00:00',
        'clients' => 4,
        'trainer' => 'Шкребтан С.О'
    ]);
    $this->insert('affairs', [
        'time' => '2017-10-12 14:00:00',
        'clients' => 4,
        'trainer' => 'Краченко І.В'
    ]);

    $this->createTable("enrolls", [
        'id' => $this->primaryKey(),
        'name' => $this->string(32),
        'second_name' => $this->string(32),
        'time_id' => $this->smallInteger(8)->unsigned()->notNull(),
        'time' => $this->dateTime(),
        'email' => $this->string(50)->notNull(),
        'phone' => $this->string(20)->notNull(),
    ]);

    $this->alterColumn('enrolls', 'id', $this->smallInteger(8)->unsigned()->unique() . ' NOT NULL AUTO_INCREMENT');

    $this->createIndex(
        'idx-enrolls-time_id',
        'enrolls',
        'time_id'
    );
    $this->insert('enrolls', [
        'name' => 'Іван',
        'second_name' => 'Кравченко',
        'time_id' => 1,
        'time' => '2017-09-26 16:00:00',
        'email' => 'vanny2@mgd.v',
        'phone' => '+380402414132'
    ]);

    $this->insert('enrolls', [
        'name' => 'Сергій',
        'second_name' => 'Шкребтан',
        'time_id' => 2,
        'time' => '2017-09-26 16:00:00',
        'email' => 'serg@ff.v',
        'phone' => '+380402414342'
    ]);
    $this->insert('enrolls', [
        'name' => 'Оля',
        'second_name' => 'Суббота',
        'time_id' => 3,
        'time' => '2017-09-26 16:00:00',
        'email' => 'ol2@msd.v',
        'phone' => '+380234514132'
    ]);
    $this->addForeignKey(
        'fk-affairs-enrolls_id',
        'enrolls',
        'time_id',
        'affairs',
        'id',
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
        echo "m170923_160121_clients cannot be reverted.\n";

        return false;
    }
    */
}
