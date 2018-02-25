<?php

use yii\db\Migration;

/**
 * Class m170127_014523_alter_column__trial__to__product
 */
class m170127_014523_alter_column__trial__to__product extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%product}}', 'trial', $this->integer());
    }

    public function down()
    {
        $this->alterColumn('{{%product}}', 'trial', $this->integer()->notNull());
    }
}
