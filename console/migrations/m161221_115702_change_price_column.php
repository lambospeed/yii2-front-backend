<?php

use yii\db\Migration;

class m161221_115702_change_price_column extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%product}}', 'price', 'float');
    }

    public function down()
    {
        return true;
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
