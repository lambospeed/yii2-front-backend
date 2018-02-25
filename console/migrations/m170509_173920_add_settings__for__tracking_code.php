<?php

use common\models\Expansion;
use common\models\SettingModel;
use yii\db\Migration;

class m170509_173920_add_settings__for__tracking_code extends Migration
{
    public function safeUp()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->insert('{{%setting_' . $expansion->id . '}}', [
                'name'        => 'Tracking code',
                'system_name' => SettingModel::SYSTEM_NAME_TRACKING_CODE,
                'value'     => <<<HTML
    <!-- tracking code -->
    <script>
        (function (d, s) {
            var js, upxf = d.getElementsByTagName(s)[0], load = function (url, id) {
                if (d.getElementById(id)) {
                    return;
                }
                if202 = d.createElement("script");
                if202.src = url;
                if202.async = true;
                if202.id = id;
                upxf.parentNode.insertBefore(if202, upxf);
            };
            load("https://truedefense.guide/tracking202/static/landing.php?lpip=919", "upxif");
        }(document, "script"));
    </script>
    <!-- end tracking code -->                
HTML
            ]);
        }
    }

    public function safeDown()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->delete('{{%text_block_' . $expansion->id . '}}', [
                'system_name' => SettingModel::SYSTEM_NAME_TRACKING_CODE,
            ]);
        }
    }
}
