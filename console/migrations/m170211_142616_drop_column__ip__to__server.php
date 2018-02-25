<?php

use yii\db\Migration;

/**
 * Class m170211_142616_drop_column__ip__to__server
 */
class m170211_142616_drop_column__ip__to__server extends Migration
{
    public function safeUp()
    {
        $this->dropColumn(
            '{{%server}}',
            'ip'
        );
    }

    public function safeDown()
    {
        $this->addColumn(
            '{{%server}}',
            'ip',
            $this->string()->notNull()->defaultValue('127.0.0.1')->after('title')
        );
    }
}
