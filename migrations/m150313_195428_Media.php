<?php

use yii\db\Schema;
use yii\db\Migration;

class m150313_195428_Media extends Migration
{
    public function up()
    {
    	$this->createTable('tbl_media',
    		array(
    			'file'=>'varchar(1024)',
				'type'=>'varchar(255)',
    		)
    	);
    }

    public function down()
    {
        echo "m150313_195428_Media cannot be reverted.\n";

        return false;
    }
}
