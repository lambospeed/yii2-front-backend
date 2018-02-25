<?php

use yii\db\Migration;

class m161219_164051_create_table_text_blocks extends Migration
{
    public function up()
    {
        $options = $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;

        $this->createTable('{{%text_block}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'system_name' => $this->string(),
            'content' => $this->text(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%text_block}}');
    }

}
