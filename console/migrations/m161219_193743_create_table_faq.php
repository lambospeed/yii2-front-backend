<?php

use yii\db\Migration;

class m161219_193743_create_table_faq extends Migration
{
    public function up()
    {
        $options = $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;

        $this->createTable('{{%faq}}', [
            'id' => $this->primaryKey(),
            'question' => $this->string()->notNull(),
            'answer' => $this->string()->notNull(),
            'display' => $this->integer()->notNull()->defaultValue(1)
        ], $options);
    }

    public function down()
    {
        $this->dropTable('{{%faq}}');
    }
}
