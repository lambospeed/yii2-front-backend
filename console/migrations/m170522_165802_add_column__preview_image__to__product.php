<?php

use common\models\Expansion;
use yii\db\Migration;

class m170522_165802_add_column__preview_image__to__product extends Migration
{
    public function up()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->addColumn(
                '{{%product_' . $expansion->id . '}}',
                'preview_image',
                $this->text()->after('image')
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
                'preview_image'
            );
        }
    }
}
