<?php

use common\models\Expansion;
use yii\db\Migration;

class m170307_181552_add_column__bottom_block_credit__to_product extends Migration
{
    public function up()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->addColumn(
                '{{%product_' . $expansion->id . '}}',
                'bottom_block_credit',
                $this->text()
            );
        }
    }

    public function down()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->dropColumn(
                '{{%product_' . $expansion->id . '}}',
                'bottom_block_credit'
            );
        }
    }
}
