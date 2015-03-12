<?php

use yii\db\Schema;
use yii\db\Migration;

class m150312_222549_baseLine extends Migration
{
    public function safeUp()
    {
    	$this->createTable('tbl_product',
    		[
    			'name' => 'string(512)',
    		]
    	);
    }

    public function safeDown()
    {
    	$this->dropTable('tbl_product');
    }
}
