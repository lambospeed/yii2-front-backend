<?php

use common\models\Expansion;
use yii\db\Migration;

/**
 * Class m170218_103500_implement__usage__expansions__for__faq
 */
class m170218_103500_implement__usage__expansions__for__faq extends Migration
{
    public function safeUp()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();

        foreach ($expansions as $expansion) {
            $command = Yii::$app->db->createCommand(
                "CREATE TABLE `faq_" . (int)$expansion->id . "` LIKE `faq`"
            );
            $command->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO `faq_" . (int)$expansion->id . "` SELECT * FROM `faq`"
            );
            $command->execute();
        }

        $command = Yii::$app->db->createCommand(
            "DROP TABLE `faq`"
        );
        $command->execute();
    }

    public function safeDown()
    {
        /** @var Expansion $defaultExpansion */
        $defaultExpansion = Expansion::find()->andFilterWhere(['default' => (int)true])->one();

        if (!empty($defaultExpansion)) {
            $command = Yii::$app->db->createCommand(
                "CREATE TABLE `faq` LIKE `faq_" . (int)$defaultExpansion->id . "`"
            );

            $command->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO `faq` SELECT * FROM `faq_" . (int)$defaultExpansion->id . "`"
            );

            $command->execute();
        }

        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();

        foreach ($expansions as $expansion) {
            $command = Yii::$app->db->createCommand(
                "DROP TABLE `faq_" . (int)$expansion->id . "`"
            );

            $command->execute();
        }
    }
}
