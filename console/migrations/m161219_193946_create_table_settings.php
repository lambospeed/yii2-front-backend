<?php

use yii\db\Migration;

class m161219_193946_create_table_settings extends Migration
{
    public function safeUp()
    {
        $options = $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;

        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'system_name' => $this->string()->unique()->notNull(),
            'value' => $this->string()->notNull(),
        ], $options);


        $this->insert('{{%setting}}', [
            'name' => 'Google + Social Link',
            'system_name' => 'g_soc_link',
            'value' => 'http://google.com'
        ]);

        $this->insert('{{%setting}}', [
            'name' => 'Twitter Social Link',
            'system_name' => 'tw_soc_link',
            'value' => 'http://twitter.com'
        ]);

        $this->insert('{{%setting}}', [
            'name' => 'Facebook Social Link',
            'system_name' => 'fb_social_link',
            'value' => 'http://facebook.com'
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%setting}}');
    }
}
