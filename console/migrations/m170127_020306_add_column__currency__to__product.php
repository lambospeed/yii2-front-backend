<?php

use yii\db\Migration;

/**
 * Class m170127_020306_add_column__currency__to__product
 */
class m170127_020306_add_column__currency__to__product extends Migration
{
    public function up()
    {
        $this->addColumn(
            '{{%product}}',
            'currency',
            $this->string()->notNull()->defaultValue('USD')->after('price')
        );
    }

    public function down()
    {
        $this->dropColumn('{{%product}}', 'currency');
    }
}
