<?php

use yii\db\Migration;

class m161221_121914_add_text_block_index_score extends Migration
{
    public function up()
    {
        $this->insert('{{%text_block}}', [
            'name' => 'Index Score Block',
            'system_name' => 'index_score',
            'content' => <<<HTML
<div class="aside__title">
                    How we score
                </div>
                <p class="aside-item__name">Nemo enim ipsam voluptatem quia
                    voluptas sit aspernatur aut odit.</p>
                <ul class="aside-score__ul">
                    <li>Product features</li>
                    <li>Product features</li>
                    <li>Product features</li>
                    <li>Product features</li>
                    <li>Product features</li>

                </ul>
HTML
        ]);
    }

    public function down()
    {
        $this->delete('{{%text_block}}', [
            'system_name' => 'index_score',
        ]);
    }

}
