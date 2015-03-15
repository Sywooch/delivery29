<?php

use yii\db\Schema;
use yii\db\Migration;

class m150315_004036_LogTable extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
         $this->createTable('tbl_log',
            [
                "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
                "created_at" => "timestamp DEFAULT CURRENT_TIMESTAMP",
                "owner_id" => "INT DEFAULT 0",
                "level" => "INT DEFAULT 0",
                "message" => "text"
            ]
        );
    }
    
    public function safeDown()
    {
    }
    
}
