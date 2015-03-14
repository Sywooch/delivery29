<?php

use yii\db\Schema;
use yii\db\Migration;

class m150313_192850_ProdictTableAI extends Migration
{
    public function up()
    {
    	$this->dropColumn( 'tbl_product', 'id' );

    	$this->addColumn( 'tbl_product', 'id', 'integer NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST' );
    }

    public function down()
    {
        echo "m150313_192850_ProdictTableAI cannot be reverted.\n";

        return false;
    }
}
