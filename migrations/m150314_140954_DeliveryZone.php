<?php

use yii\db\Schema;
use yii\db\Migration;

class m150314_140954_DeliveryZone extends Migration
{
   
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_delivery_zone',
            [
                "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
                "name" => "varchar(255)",
                "delivery_price"=> "float(7,3)",
                "active" => "int(1) DEFAULT '1'"
            ]
        );
    }
    
    public function safeDown()
    {
    }
    
}
