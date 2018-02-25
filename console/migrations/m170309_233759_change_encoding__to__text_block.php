<?php

use common\models\Expansion;
use yii\db\Migration;

/**
 * Class m170309_233759_change_encoding__to__text_block
 */
class m170309_233759_change_encoding__to__text_block extends Migration
{
    public function up()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $tableName = "text_block_" . $expansion->id;
            $query = <<<SQL
ALTER TABLE {$tableName}
  DEFAULT CHARSET=utf8
  COLLATE=utf8_unicode_ci
SQL;

            $this->execute($query);

            $this->alterColumn(
                $tableName,
                'name',
                    $this->string()
            );

            $this->alterColumn(
                $tableName,
                'system_name',
                $this->string()
            );

            $this->alterColumn(
                $tableName,
                'content',
                $this->string()
            );
        }
    }

    public function down()
    {
        /** @var Expansion[] $expansions */
        $expansions = Expansion::find()->all();
        foreach ($expansions as $expansion) {
            $tableName = "text_block_" . $expansion->id;
            $query = <<<SQL
ALTER TABLE {$tableName}
  DEFAULT CHARSET=latin1
SQL;

            $this->execute($query);

            $this->alterColumn(
                $tableName,
                'name',
                $this->string()
            );

            $this->alterColumn(
                $tableName,
                'system_name',
                $this->string()
            );

            $this->alterColumn(
                $tableName,
                'content',
                $this->string()
            );
        }
    }
}
