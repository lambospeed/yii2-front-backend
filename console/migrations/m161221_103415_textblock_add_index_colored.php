<?php

use yii\db\Migration;

class m161221_103415_textblock_add_index_colored extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%text_block}}', [
            'name' => 'Index Colored Left',
            'system_name' => 'index_colored_left',
            'content' => <<<HTML
<article>
            <div class="h2-like">How identity protect works</div>
            <p class="base-p">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae
                vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                qui dolorem , consectetur, adipisci velit.</p>
        </article>
HTML
        ]);
        $this->insert('{{%text_block}}', [
            'name' => 'Index Colored Right',
            'system_name' => 'index_colored_right',
            'content' => <<<HTML
 <article>
            <div class="h2-like">How identity protect works</div>
            <p class="base-p">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae
                vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est,
                qui dolorem , consectetur, adipisci velit.</p>
        </article>
HTML
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%text_block}}', [
            'system_name' => 'index_colored_right',
        ]);
        $this->delete('{{%text_block}}', [
            'system_name' => 'index_colored_left',
        ]);
    }
}
