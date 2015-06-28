<?php

use yii\db\Schema;
use yii\db\Migration;

class m150627_103022_HandMadeItemFix extends Migration
{
    public function up()
    {
        $this->addColumn("tbl_hand_made_item", "active", "integer DEFAULT 0");
        $this->addColumn("tbl_hand_made_item", "sort", "integer DEFAULT 0");
    }

    public function down()
    {
        echo "m150627_103022_HandMadeItemFix cannot be reverted.\n";

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
