<?php

use common\models\Expansion;
use yii\db\Migration;

class m170509_173649_alter_column__value__to__setting extends Migration
{
    public function up()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->alterColumn(
                "setting_" . $expansion->id,
                'value',
                $this->text()
            );
        }
    }

    public function down()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->alterColumn(
                "setting_" . $expansion->id,
                'value',
                $this->string()
            );
        }
    }
}
