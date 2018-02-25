<?php

use common\models\Expansion;
use yii\db\Migration;

/**
 * Class m170218_170332_implement__usage__expansions__for__setting
 */
class m170218_170332_implement__usage__expansions__for__setting extends Migration
{
    public function safeUp()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();

        foreach ($expansions as $expansion) {
            $command = Yii::$app->db->createCommand(
                "CREATE TABLE `setting_" . (int)$expansion->id . "` LIKE `setting`"
            );
            $command->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO `setting_" . (int)$expansion->id . "` SELECT * FROM `setting`"
            );
            $command->execute();
        }

        $command = Yii::$app->db->createCommand(
            "DROP TABLE `setting`"
        );
        $command->execute();
    }

    public function safeDown()
    {
        /** @var Expansion $defaultExpansion */
        $defaultExpansion = Expansion::find()->andFilterWhere(['default' => (int)true])->one();

        if (!empty($defaultExpansion)) {
            $command = Yii::$app->db->createCommand(
                "CREATE TABLE `setting` LIKE `setting_" . (int)$defaultExpansion->id . "`"
            );

            $command->execute();

            $command = Yii::$app->db->createCommand(
                "INSERT INTO `setting` SELECT * FROM `setting_" . (int)$defaultExpansion->id . "`"
            );

            $command->execute();
        }

        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();

        foreach ($expansions as $expansion) {
            $command = Yii::$app->db->createCommand(
                "DROP TABLE `setting_" . (int)$expansion->id . "`"
            );

            $command->execute();
        }
    }
}
