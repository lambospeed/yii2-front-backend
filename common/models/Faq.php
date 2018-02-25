<?php

namespace common\models;

use yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%faq}}".
 *
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property integer $display
 */
class Faq extends ActiveRecord
{
    public static function tableName()
    {
        return 'faq' . Yii::$app->get('expansion')->getTableSuffix();
    }

    public function rules()
    {
        return [
            [['question', 'answer'], 'required'],
            [['display'], 'integer'],
            [['question', 'answer'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'display' => 'Display Status',
        ];
    }
}
