<?php

use yii\db\Migration;

class m161221_092950_add_text_block_disclaimer extends Migration
{
    public function up()
    {
        $this->insert('{{%text_block}}', [
            'name' => 'Disclaimer Text',
            'system_name' => 'disclaimer_text',
            'content' => 'Disclaimer: Our top ranked sites are reviewed on the basis of our own views, knowledge and expert opinions. We are able to provide you with our free online comparison tool thanks to referral fees we receive from a number of companies that are compared and reviewed on our website. We do not review all products in a given category. We are independently owned and operated and all opinions expressed on this site are our own.',
        ]);
    }

    public function down()
    {
        $this->delete('{{%text_block}}', [
            'system_name' => 'disclaimer_text',
        ]);
    }
}
