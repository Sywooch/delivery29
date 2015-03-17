<?php

use yii\db\Schema;
use yii\db\Migration;

class m150317_225428_ComplexFix extends Migration
{
    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->addColumn('tbl_product', 'sort', 'int DEFAULT 100');
        $this->addColumn('tbl_media', 'external_id', 'int');
    }
    
    public function safeDown()
    {
    }
    
}
