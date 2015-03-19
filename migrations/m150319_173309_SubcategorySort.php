<?php

use yii\db\Schema;
use yii\db\Migration;

class m150319_173309_SubcategorySort extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->addColumn('tbl_subcategory', 'sort', 'int DEFAULT 100');
    }
    
    public function safeDown()
    {
    }
}
