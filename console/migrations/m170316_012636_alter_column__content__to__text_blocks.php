<?php

use common\models\Expansion;
use yii\db\Migration;

/**
 * Class m170316_012636_alter_column__content__to__text_blocks
 */
class m170316_012636_alter_column__content__to__text_blocks extends Migration
{
    public function up()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $this->alterColumn(
                "text_block_" . $expansion->id,
                'content',
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
                "text_block_" . $expansion->id,
                'content',
                $this->string()
            );
        }
    }
}
