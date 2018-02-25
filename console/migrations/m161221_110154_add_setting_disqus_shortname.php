<?php

use yii\db\Migration;

class m161221_110154_add_setting_disqus_shortname extends Migration
{
    public function up()
    {
        $this->insert('{{%setting}}', [
            'name' => 'Disqus Short Name',
            'system_name' => 'disqus_shortname',
            'value' => 'defensetest'
        ]);
    }

    public function down()
    {
        $this->delete('{{%setting}}', [
            'system_name' => 'disqus_shortname',
        ]);
    }
}
