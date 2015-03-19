<?php

use yii\db\Schema;
use yii\db\Migration;

class m150318_230844_SubCatAndCat extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->addColumn("tbl_category", "path", "varchar(255)");
        $this->addColumn("tbl_category", "icon", "int");
        $this->addColumn("tbl_product", "subcategory_id", "int DEFAULT 0");
    }
    
    public function safeDown()
    {
    }
}
