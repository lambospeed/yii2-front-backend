<?php

use yii\db\Migration;

/**
 * Class m170211_141220_add_columns__user__path__host__to__server
 */
class m170211_141220_add_columns__user__path__host__to__server extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            '{{%server}}',
            'user',
            $this->string()->notNull()->defaultValue('master')->after('title')
        );

        $this->addColumn(
            '{{%server}}',
            'host',
            $this->string()->notNull()->defaultValue('truedefense.org')->after('user')
        );

        $this->addColumn(
            '{{%server}}',
            'path',
            $this->string()
                ->notNull()
                ->defaultValue('/home/master/applications/truedefense_org')
                ->after('host')
        );
    }

    public function safeDown()
    {
        $this->dropColumn('{{%server}}', 'path');
        $this->dropColumn('{{%server}}', 'host');
        $this->dropColumn('{{%server}}', 'user');
    }
}
