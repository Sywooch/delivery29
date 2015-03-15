<?php

use yii\db\Schema;
use yii\db\Migration;

class m150315_201945_DZoneNameSort extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->addColumn('tbl_delivery_zone', 'sort', 'int DEFAULT 100');
    }
    
    public function safeDown()
    {
    }
    
}
