<?php

use yii\db\Schema;
use yii\db\Migration;

class m150319_171840_SubcategoryTbl extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_subcategory', [
                'id' => "int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY",
                'name' => "varchar(512)",
                'description' => 'text',
                'active' => 'int DEFAULT 1',
            ]
        );
    }
    
    public function safeDown()
    {
    }
    
}
