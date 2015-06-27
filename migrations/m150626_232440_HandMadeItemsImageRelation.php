<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_232440_HandMadeItemsImageRelation extends Migration
{
    public function up()
    {
        $this->createTable('tbl_hand_made_item_image_relation',
            [
                "item_id" => "int(11) NOT NULL",
                "media_id" => "int(11) NOT NULL"
            ]
        );
        $this->addPrimaryKey("index", "tbl_hand_made_item_image_relation", ['item_id', 'media_id']);
    }

    public function down()
    {
        echo "m150626_232440_HandMadeItemsImageRelation cannot be reverted.\n";

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
