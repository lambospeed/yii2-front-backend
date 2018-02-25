<?php

use common\models\Expansion;
use yii\db\Migration;

/**
 * Class m170329_220806_add_column__original_price__to__product
 */
class m170329_220806_add_column__original_price__to__product extends Migration
{
    public function up()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->addColumn(
                '{{%product_' . $expansion->id . '}}',
                'original_price',
                $this->string()->after('price')
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
                'original_price'
            );
        }
    }
}
