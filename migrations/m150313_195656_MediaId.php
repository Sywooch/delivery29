<?php

use yii\db\Schema;
use yii\db\Migration;

class m150313_195656_MediaId extends Migration
{
    public function up()
    {
    	$this->addColumn('tbl_media', 'id', 'integer NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST');
    }

    public function down()
    {
        echo "m150313_195656_MediaId cannot be reverted.\n";

        return false;
    }
}
