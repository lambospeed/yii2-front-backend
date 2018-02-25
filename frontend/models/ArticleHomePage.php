<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_home_page".
 *
 * @property integer $id
 * @property integer $id_pages
 * @property string $type
 * @property string $title
 * @property string $description
 *
 * @property Home $idPages
 */
class ArticleHomePage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_home_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pages'], 'integer'],
            [['title', 'description'], 'string'],
            [['type'], 'string', 'max' => 255],
            [['id_pages'], 'exist', 'skipOnError' => true, 'targetClass' => Home::className(), 'targetAttribute' => ['id_pages' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pages' => 'Id Pages',
            'type' => 'Type',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPages()
    {
        return $this->hasOne(Home::className(), ['id' => 'id_pages']);
    }
}
