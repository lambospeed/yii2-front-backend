<?php

use yii\db\Migration;

/**
 * Class m170307_221723_add_column__need_cookies_law__to_expansion
 */
class m170307_221723_add_column__need_cookies_law__to_expansion extends Migration
{
    public function up()
    {
        $this->addColumn(
            '{{%expansion}}',
            'need_cookies_law',
            $this->boolean()->defaultValue(false)
        );
    }

    public function down()
    {
        $this->dropColumn('{{%expansion}}', 'need_cookies_law');
    }
}
