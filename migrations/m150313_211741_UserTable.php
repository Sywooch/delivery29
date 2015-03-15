<?php

use yii\db\Schema;
use yii\db\Migration;

class m150313_211741_UserTable extends Migration
{
    public function up()
    {
        $this->createTable("user", array(
                "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
                "username" => "varchar(255) NOT NULL",
                "auth_key" => "varchar(32) NOT NULL",
                "password_hash" => "varchar(255) NOT NULL",
                "password_reset_token" => "varchar(255)",
                "email" => "varchar(255) NOT NULL",
                "status" => "smallint(6) NOT NULL DEFAULT 10",
                "created_at" => "int(11) NOT NULL",
                "updated_at" => "int(11) NOT NULL",
             )
        );
    }

    public function down()
    {
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
