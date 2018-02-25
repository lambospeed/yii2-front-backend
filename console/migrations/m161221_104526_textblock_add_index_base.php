<?php

use yii\db\Migration;

class m161221_104526_textblock_add_index_base extends Migration
{
    public function up()
    {
        $this->insert('{{%text_block}}', [
            'name' => 'Index Base',
            'system_name' => 'index_base',
            'content' => <<<HTML
<article>
            <div class="h2-like">Lorem ipsum dolor sit amet</div>
            <p class="base-p">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam
                rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui
                dolorem , consectetur, adipisci velit.
            </p>
        </article>
        <article>
            <div class="h2-like">Duis aute irure dolor in reprehenderit</div>
            <p class="base-p">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam
                rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui
                dolorem , consectetur, adipisci velit.
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam
                rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui
                dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora
                incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
            </p>
        </article>
        <article>
            <div class="h2-like">Lorem ipsum dolor sit amet</div>
            <p class="base-p">
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam
                rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
                explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui
                dolorem , consectetur, adipisci velit.
            </p>
        </article>
HTML
        ]);
    }

    public function down()
    {
        $this->delete('{{%text_block}}', [
            'system_name' => 'index_base',
        ]);
    }
}
