<?php

use yii\db\Schema;
use yii\db\Migration;

class m150315_200444_DZoneName extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->addColumn('tbl_delivery_zone', 'name_to', 'varchar(255)');
    }
    
    public function safeDown()
    {
    }
    
}
