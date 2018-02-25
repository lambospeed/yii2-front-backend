<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "home".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $check_block_title
 * @property string $check_block_description
 * @property string $copyright
 * @property string $vk_href
 * @property string $fb_href
 * @property string $tw_href
 *
 * @property ArticleHomePage[] $articleHomePages
 */
class Home extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'content', 'check_block_title', 'check_block_description', 'copyright', 'vk_href', 'fb_href', 'tw_href'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'check_block_title' => 'Check Block Title',
            'check_block_description' => 'Check Block Description',
            'copyright' => 'Copyright',
            'vk_href' => 'Vk Href',
            'fb_href' => 'Fb Href',
            'tw_href' => 'Tw Href',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleHomePages()
    {
        return $this->hasMany(ArticleHomePage::className(), ['id_pages' => 'id']);
    }
}
