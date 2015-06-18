<?php

use yii\db\Migration;

class m150618_061813_DiscountForDelivery extends Migration
{


    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->addColumn('tbl_delivery_zone', 'discount', 'int DEFAULT 0');
    }
    
    public function safeDown()
    {
    }

}
