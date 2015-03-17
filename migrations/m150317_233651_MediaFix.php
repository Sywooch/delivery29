<?php

use yii\db\Schema;
use yii\db\Migration;

class m150317_233651_MediaFix extends Migration
{
    public function up()
    {
        $this->addColumn('tbl_media', 'external_id_hash', 'varchar(512)');
    }

    public function down()
    {
        echo "m150317_233651_MediaFix cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
