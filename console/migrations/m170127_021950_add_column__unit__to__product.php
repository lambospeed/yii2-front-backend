<?php

use yii\db\Migration;

/**
 * Class m170127_021950_add_column__unit__to__product
 */
class m170127_021950_add_column__unit__to__product extends Migration
{
    public function up()
    {
        $this->addColumn(
            '{{%product}}',
            'unit',
            $this->string()->notNull()->defaultValue('mo')->after('currency')
        );
    }

    public function down()
    {
        $this->dropColumn('{{%product}}', 'unit');
    }
}
