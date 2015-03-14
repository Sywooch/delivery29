<?php

use yii\db\Schema;
use yii\db\Migration;

class m150313_192056_ProdictTable extends Migration
{
    public function up()
    {
    	$this->addColumn('tbl_product', 'id', 'integer');
    	$this->addColumn('tbl_product', 'description', 'text');
    	$this->addColumn('tbl_product', 'price', 'float(7,5)');
    	$this->addColumn('tbl_product', 'category_id', 'integer');
    	$this->addColumn('tbl_product', 'active', 'integer');
    	$this->addColumn('tbl_product', 'image_id', 'integer');
    	$this->addColumn('tbl_product', 'external_id', 'varchar(255)');
    	$this->addColumn('tbl_product', 'buy_counter', 'integer');
    }

    public function down()
    {
        echo "m150313_192056_ProdictTable cannot be reverted.\n";

        return false;
    }
}
