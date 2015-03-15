<?php

use yii\db\Schema;
use yii\db\Migration;

class m150314_230618_OrderDataTbl extends Migration
{
    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_order_data',
            [
                "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
                "order_id" => "integer",
                "item_id" => "integer",
                "count" => "integer"
            ]
        );
    }
    
    public function safeDown()
    {
    }
    
}
