<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_235606_OrderTypes extends Migration
{
    public function up()
    {
        $this->addColumn('tbl_order', 'type', 'integer DEFAULT 1');
        $this->addColumn('tbl_order_data', 'type', 'integer DEFAULT 1');
    }

    public function down()
    {
        echo "m150626_235606_OrderTypes cannot be reverted.\n";

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
