<?php
use yii\db\Schema;
use yii\db\Migration;

class m170509_075558_newtable extends Migration
{
    public function up()
    {
        $this->createTable('newtable',[
            'id'=>Schema::TYPE_PK,
            'title'=>Schema::TYPE_STRING,
            'content'=>Schema::TYPE_TEXT,
            ]);
    } 

    public function down()
    {
        echo "m170509_075558_newtable cannot be reverted.\n";
        $this->dropTable('newtable');
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
