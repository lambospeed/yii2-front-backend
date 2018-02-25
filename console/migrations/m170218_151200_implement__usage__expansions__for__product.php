<?php

use common\models\Expansion;
use yii\db\Migration;

/**
 * Class m170218_151200_implement__usage__expansions__for__product
 */
class m170218_151200_implement__usage__expansions__for__product extends Migration
{
    public function safeUp()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();

        foreach ($expansions as $expansion) {
            $command = Yii::$app->db->createCommand(
                "CREATE TABLE `product_" . (int)$expansion->id . "` LIKE `product`"
            );
            $command->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO `product_" . (int)$expansion->id . "` SELECT * FROM `product`"
            );
            $command->execute();
        }

        $command = Yii::$app->db->createCommand(
            "DROP TABLE `product`"
        );
        $command->execute();
    }

    public function safeDown()
    {
        /** @var Expansion $defaultExpansion */
        $defaultExpansion = Expansion::find()->andFilterWhere(['default' => (int)true])->one();

        if (!empty($defaultExpansion)) {
            $command = Yii::$app->db->createCommand(
                "CREATE TABLE `product` LIKE `product_" . (int)$defaultExpansion->id . "`"
            );

            $command->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO `product` SELECT * FROM `product_" . (int)$defaultExpansion->id . "`"
            );

            $command->execute();
        }

        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();

        foreach ($expansions as $expansion) {
            $command = Yii::$app->db->createCommand(
                "DROP TABLE `product_" . (int)$expansion->id . "`"
            );

            $command->execute();
        }
    }
}
