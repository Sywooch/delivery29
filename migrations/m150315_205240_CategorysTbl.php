<?php

use yii\db\Schema;
use yii\db\Migration;

class m150315_205240_CategorysTbl extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
         $this->createTable('tbl_category',
            [
                "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
                "created_at" => "timestamp DEFAULT CURRENT_TIMESTAMP",
                "name" => "varchar(1024)",
                "media_id" => "int",
                "active" => "int",
                "sort" => "int DEFAULT 100",
            ]
        );
    }
    
    public function safeDown()
    {
    }
}
