<?php

use yii\db\Migration;

/**
 * Class m170212_143257_create_table__expansion
 */
class m170212_143257_create_table__expansion extends Migration
{
    private $_table = '{{%expansion}}';

    public function up()
    {
        $options = $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;

        $this->createTable(
            $this->_table,
            [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'code' => $this->string()->notNull()->unique(),
                'default' => $this->boolean()->notNull()->defaultValue(false),
                'countries' => $this->text()->notNull()->defaultValue(''),
            ],
            $options
        );
    }

    public function down()
    {
        $this->dropTable($this->_table);
    }
}
