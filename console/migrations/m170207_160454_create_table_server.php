<?php

use yii\db\Migration;

/**
 * Class m170207_160454_create_table_server
 */
class m170207_160454_create_table_server extends Migration
{
    private $_table = '{{%server}}';

    public function up()
    {
        $options = $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;

        $this->createTable(
            $this->_table,
            [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'ip' => $this->string()->notNull(),
            ],
            $options
        );
    }

    public function down()
    {
        $this->dropTable($this->_table);
    }
}
