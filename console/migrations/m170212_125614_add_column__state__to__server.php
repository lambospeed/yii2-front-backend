<?php

use yii\db\Migration;

/**
 * Class m170212_125614_add_column__state__to__server
 */
class m170212_125614_add_column__state__to__server extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            '{{%server}}',
            'state',
            $this->string()->notNull()->defaultValue('synced')->after('path')
        );
    }

    public function safeDown()
    {
        $this->dropColumn('{{%server}}', 'state');
    }
}
