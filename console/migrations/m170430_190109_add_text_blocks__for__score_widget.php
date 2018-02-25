<?php

use common\models\Expansion;
use yii\db\Migration;

class m170430_190109_add_text_blocks__for__score_widget extends Migration
{
    public function safeUp()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->insert('{{%text_block_' . $expansion->id . '}}', [
                'name'        => 'Score title',
                'system_name' => 'score_title',
                'content'     => <<<TEXT
    How We Scored Products            
TEXT
            ]);

            $this->insert('{{%text_block_' . $expansion->id . '}}', [
                'name'        => 'Score name',
                'system_name' => 'score_name',
                'content'     => <<<TEXT
    We Rated and Reviewed in 2017 Based on These Features                    
TEXT
            ]);

            $this->insert('{{%text_block_' . $expansion->id . '}}', [
                'name'        => 'Score list',
                'system_name' => 'score_list',
                'content'     => <<<HTML
    <ul class="aside-score__ul">
        <li>Identity Protection</li>
        <li>Credit Monitoring</li>
        <li>Identity Monitoring</li>
        <li>Insurance/Guarantees</li>
        <li>Computer Security</li>
    </ul>
HTML
            ]);

        }
    }

    public function safeDown()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->delete('{{%text_block_' . $expansion->id . '}}', [
                'system_name' => 'score_title',
            ]);

            $this->delete('{{%text_block_' . $expansion->id . '}}', [
                'system_name' => 'score_name',
            ]);

            $this->delete('{{%text_block_' . $expansion->id . '}}', [
                'system_name' => 'score_list',
            ]);
        }
    }
}
