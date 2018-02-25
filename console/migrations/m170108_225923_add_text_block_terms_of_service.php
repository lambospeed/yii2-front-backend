<?php

use yii\db\Migration;

class m170108_225923_add_text_block_terms_of_service extends Migration
{
    public function up()
    {
        $this->insert('{{%text_block}}', [
            'name' => 'Terms of service popup content',
            'system_name' => 'terms_of_service',
            'content' => <<<HTML
Please set content via control panel.
HTML
        ]);
    }

    public function down()
    {
        $this->delete('{{%text_block}}', [
            'system_name' => 'terms_of_service',
        ]);
    }
}
