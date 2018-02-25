<?php

use common\models\Expansion;
use yii\db\Migration;

/**
 * Class m170307_013125_add_column__bottom_block_content__to_product
 */
class m170307_013125_add_column__bottom_block_content__to_product extends Migration
{
    public function up()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->addColumn(
                '{{%product_' . $expansion->id . '}}',
                'bottom_block_content',
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
                'bottom_block_content'
            );
        }
    }
}
