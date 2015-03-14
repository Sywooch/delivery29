<?php

use yii\db\Schema;
use yii\db\Migration;

class m150313_193324_TestProduct extends Migration
{
    public function up()
    {
    	$this->insert("tbl_product", array(
    			"name" => "Биг Мак",
    			"description" => "Большой сендвич с двумя рубленными котлетами",
    			"price" => "95",
				"category_id" => "1",
				"active" => "1",
				"image_id" => "1",
				"external_id" => "",
				"buy_counter" => "0",
    		)
    	);
    	$this->insert("tbl_product", array(
    			"name" => "Филе о фиш",
    			"description" => "Филе хорошо прожаленой рыбы",
    			"price" => "95",
				"category_id" => "1",
				"active" => "1",
				"image_id" => "2",
				"external_id" => "",
				"buy_counter" => "0",
    		)
    	);
    }

    public function down()
    {
        echo "m150313_193324_TestProduct cannot be reverted.\n";

        return false;
    }
}
