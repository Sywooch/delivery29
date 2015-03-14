<?php

use yii\db\Schema;
use yii\db\Migration;

class m150314_121352_SessionTbl extends Migration
{
    // public function up()
    // {

    // }

    // public function down()
    // {
    //     echo "m150314_121352_SessionTbl cannot be reverted.\n";

    //     return false;
    // }
    
    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_session',
            [
                "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
                "hash" => "varchar(255)",
                "created_at"=> "timestamp DEFAULT CURRENT_TIMESTAMP",
                "ip" => "varchar(100)"
            ]
        );
    }
    
    public function safeDown()
    {
    }
}
