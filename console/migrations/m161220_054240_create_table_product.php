<?php

use yii\db\Migration;

class m161220_054240_create_table_product extends Migration
{
    private $_table = '{{%product}}';

    public function up()
    {
        $options = $this->db->driverName == 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB' : null;

        $this->createTable($this->_table, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'info' => $this->text(),
            'score_rating' => $this->float()->notNull()->defaultValue(0),
            'star_rating' => $this->float()->notNull()->defaultValue(0),
            'review_count' => $this->integer()->notNull()->defaultValue(1),
            'link' => $this->string()->notNull(),
            'price' => $this->decimal()->notNull(),
            'image' => $this->string(),
            'pick_label' => $this->smallInteger()->notNull()->defaultValue(0),
            'review' => $this->text()->notNull(),
            'full_features' => $this->text()->notNull(),
            'short_features' => $this->text()->notNull(),
            'trial' => $this->integer()->notNull(),
            'sort_order' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'meta_description' => $this->string()->notNull(),
            'meta_keywords' => $this->string()->notNull(),
        ], $options);
    }

    public function down()
    {
        $this->dropTable($this->_table);
    }
}
