<?php

use yii\db\Migration;

class m161221_103037_add_text_block_index_header extends Migration
{
    public function up()
    {
        $this->insert('{{%text_block}}', [
            'name' => 'Index Header',
            'system_name' => 'index_header',
            'content' => <<<HTML
<div class="h1-like">Top 2016 identity security software</div>
    <p class="head-p base-p">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
        laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
        architecto. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
        totam rem aperiam.</p>
HTML
        ]);
    }

    public function down()
    {
        $this->delete('{{%text_block}}', [
            'system_name' => 'index_header',
        ]);
    }
}
