<?php

use common\models\Expansion;
use yii\db\Migration;

class m170304_011734_add_text_block_bottom_disclaimer extends Migration
{
    public function safeUp()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->insert('{{%text_block_' . $expansion->id . '}}', [
                'name'        => 'Bottom Disclaimer Block',
                'system_name' => 'bottom_disclaimer',
                'content'     => <<<TEXT
            Our top ranked sites are reviewed on the basis of our own views, knowledge and expert opinions. We are able to provide you with our free online comparison tool thanks to referral fees we receive from a number of companies that are compared and reviewed on our website. We do not review all products in a given category. We are independently owned and operated and all opinions expressed on this site are our own.
TEXT
            ]);
        }
    }

    public function safeDown()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->delete('{{%text_block_' . $expansion->id . '}}', [
                'system_name' => 'bottom_disclaimer',
            ]);
        }
    }
}
