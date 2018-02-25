<?php

namespace common\models;

use yii;
use yii\db\ActiveRecord;

/**
 * Class TextBlock
 * @package common\models
 *
 * This is the model class for table "{{%text_block}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $system_name
 * @property string $content
 */
class TextBlock extends ActiveRecord
{
    const BOTTOM_DISCLAIMER = 'bottom_disclaimer';
    const DISCLAIMER_TEXT = 'disclaimer_text';
    const INDEX_HEADER = 'index_header';
    const INDEX_COLORED_LEFT = 'index_colored_left';
    const INDEX_COLORED_RIGHT = 'index_colored_right';
    const INDEX_BASE_BLOCK = 'index_base';
    const INDEX_SCORE = 'index_score';
    const TERMS_OF_SERVICE = 'terms_of_service';
    const PRIVACY_POLICY = 'privacy_policy';
    const SCORE_LIST = 'score_list';
    const SCORE_NAME = 'score_name';
    const SCORE_TITLE = 'score_title';

    public static function tableName()
    {
        return 'text_block' . Yii::$app->get('expansion')->getTableSuffix();
    }

    /**
     * @param $systemName
     * @return string
     */
    public static function getTextBlock($systemName)
    {
        $model = static::findOne(['system_name' => $systemName]);
        return $model->content;
    }

    public function rules()
    {
        return [
            [['content'], 'string'],
            [['name', 'system_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'system_name' => 'System name',
            'content' => 'Content',
        ];
    }
}
