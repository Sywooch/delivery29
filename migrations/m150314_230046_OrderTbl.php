<?php

use yii\db\Schema;
use yii\db\Migration;

class m150314_230046_OrderTbl extends Migration
{
    
    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_order',
            [
                "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
                "created_at" => "timestamp DEFAULT CURRENT_TIMESTAMP",
                "tel" => "varchar(255)",
                "address" => "varchar(1024)",
                "comment"=> "varchar(1024)",
                "session_id" => "integer",
                "total" => "float(12,3)",
                "status" => "int(1) DEFAULT '1'"
            ]
        );
    }
    
    public function safeDown()
    {
    }
    
}
