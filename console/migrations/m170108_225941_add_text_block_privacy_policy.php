<?php

use yii\db\Migration;

class m170108_225941_add_text_block_privacy_policy extends Migration
{
    public function up()
    {
        $this->insert('{{%text_block}}', [
            'name' => 'Privacy police popup content',
            'system_name' => 'privacy_policy',
            'content' => <<<HTML
Please set content via control panel.
HTML
        ]);
    }

    public function down()
    {
        $this->delete('{{%text_block}}', [
            'system_name' => 'privacy_policy',
        ]);
    }
}
