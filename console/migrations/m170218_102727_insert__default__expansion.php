<?php

use yii\db\Migration;

/**
 * Class m170218_102727_insert__default__expansion
 */
class m170218_102727_insert__default__expansion extends Migration
{
    public function up()
    {
        $this->insert(
            '{{%expansion%}}',
            [
                'title' => 'Default',
                'code' => 'Default',
                'default' => (int)true,
            ]
        );
    }

    public function down()
    {
        $this->delete(
            '{{%expansion%}}',
            [
                'default' => (int)true,
            ]
        );
    }
}
