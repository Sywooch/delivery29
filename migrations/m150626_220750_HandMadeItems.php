<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_220750_HandMadeItems extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_hand_made_item',
            [
                "id" => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
                "price" => "integer",
                "discount" => "integer",
                "preview_id" => "integer",
                "name" => "string",
                "description" => "text",
                "short_description" => "text",
                "slug" => "string",
            ]
        );
    }
    
    public function safeDown()
    {
        return false;
    }

}
