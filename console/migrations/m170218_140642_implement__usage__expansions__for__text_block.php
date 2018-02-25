<?php

use common\models\Expansion;
use yii\db\Migration;

/**
 * Class m170218_140642_implement__usage__expansions__for__text_block
 */
class m170218_140642_implement__usage__expansions__for__text_block extends Migration
{
    public function safeUp()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();

        foreach ($expansions as $expansion) {
            $command = Yii::$app->db->createCommand(
                "CREATE TABLE `text_block_" . (int)$expansion->id . "` LIKE `text_block`"
            );
            $command->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO `text_block_" . (int)$expansion->id . "` SELECT * FROM `text_block`"
            );
            $command->execute();
        }

        $command = Yii::$app->db->createCommand(
            "DROP TABLE `text_block`"
        );
        $command->execute();
    }

    public function safeDown()
    {
        /** @var Expansion $defaultExpansion */
        $defaultExpansion = Expansion::find()->andFilterWhere(['default' => (int)true])->one();

        if (!empty($defaultExpansion)) {
            $command = Yii::$app->db->createCommand(
                "CREATE TABLE `text_block` LIKE `text_block_" . (int)$defaultExpansion->id . "`"
            );

            $command->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO `text_block` SELECT * FROM `text_block_" . (int)$defaultExpansion->id . "`"
            );

            $command->execute();
        }

        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();

        foreach ($expansions as $expansion) {
            $command = Yii::$app->db->createCommand(
                "DROP TABLE `text_block_" . (int)$expansion->id . "`"
            );

            $command->execute();
        }
    }
}
