<?php

use yii\db\Schema;
use yii\db\Migration;

class m150315_202329_OrderZone extends Migration
{
    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->addColumn('tbl_order', 'zone_id', 'integer');
    }
    
    public function safeDown()
    {
    }
    
}
