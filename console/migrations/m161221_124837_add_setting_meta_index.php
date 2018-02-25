<?php

use yii\db\Migration;

class m161221_124837_add_setting_meta_index extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%setting}}', [
            'name' => 'Index Page meta description',
            'system_name' => 'index_meta_desc',
            'value' => 'some index meta desc'
        ]);

        $this->insert('{{%setting}}', [
            'name' => 'Index Page meta keywords',
            'system_name' => 'index_meta_keywords',
            'value' => 'key key1 key2 key3'
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%setting}}', [
            'system_name' => 'index_meta_keywords',
        ]);
        $this->delete('{{%setting}}', [
            'system_name' => 'index_meta_desc',
        ]);
    }
}
