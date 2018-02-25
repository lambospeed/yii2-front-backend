<?php

use common\models\Expansion;
use yii\db\Migration;

/**
 * Class m170309_223717_add_column__category__to__product
 */
class m170309_223717_add_column__category__to__product extends Migration
{
    public function up()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->addColumn(
                '{{%product_' . $expansion->id . '}}',
                'category',
                $this->string()->after('id')->defaultValue('Identity Theft Protection')
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
                'category'
            );
        }
    }
}
