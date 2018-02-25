<?php

namespace common\models;

use yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class Product
 * @package common\models
 *
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $category
 * @property string $title
 * @property string $description
 * @property string $info
 * @property double $score_rating
 * @property double $star_rating
 * @property string $link
 * @property string $price
 * @property string $original_price
 * @property string $currency
 * @property string $unit
 * @property string $image
 * @property string $preview_image
 * @property integer $pick_label
 * @property string $review
 * @property string $full_features
 * @property string $short_features
 * @property integer $trial
 * @property integer $sort_order
 * @property integer $status
 * @property integer $review_count
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $bottom_block_title
 * @property string $bottom_block_content
 * @property string $bottom_block_credit
 *
 * @method string getUploadedFilePath(string $attribute)
 * @method string getUploadedFileUrl(string $attribute)
 */
class Product extends ActiveRecord
{
    const PREVIEW_WIDTH = 190;
    const PREVIEW_HEIGHT = 80;

    public static function tableName()
    {
        return 'product' . Yii::$app->get('expansion')->getTableSuffix();
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    public function rules()
    {
        return [
            [
                [
                    'category',
                    'title',
                    'description',
                    'link',
                    'price',
                    'currency',
                    'unit',
                    'review',
                    'full_features',
                    'short_features',
                    'review_count'
                ],
                'required'
            ],
            [
                [
                    'title',
                    'category',
                ],
                'filter',
                'filter' => 'trim'
            ],
            [
                [
                    'category',
                    'currency',
                    'unit',
                    'description',
                    'info',
                    'review',
                    'full_features',
                    'short_features',
                    'meta_description',
                    'meta_keywords',
                    'bottom_block_title',
                    'bottom_block_content',
                    'bottom_block_credit',
                ],
                'string'
            ],
            [
                [
                    'star_rating',
                    'price',
                    'original_price',
                ],
                'number'
            ],
            [
                [
                    'pick_label',
                    'trial',
                    'sort_order',
                    'status',
                    'review_count'
                ],
                'integer'
            ],
            [
                [
                    'score_rating'
                ],
                'number',
                'max' => 10
            ],
            [
                [
                    'title',
                    'link'
                ],
                'string',
                'max' => 255
            ],
            ['image', 'required', 'on' => 'create'],
            [
                'image',
                'file',
                'extensions' => 'jpg, jpeg, gif, png',
                'on' => 'create',
            ],
            [
                'image',
                'string',
                'on' => 'clone'
            ],
            [
                'preview_image',
                'string',
            ],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class'     => '\yiidreamteam\upload\FileUploadBehavior',
                'attribute' => 'image',
                'filePath'  => '@frontend/web/uploads/product/[[pk]].[[extension]]',
                'fileUrl'   => ArrayHelper::getValue(
                        Yii::$app->params,
                        'url.frontend'
                    ) . '/uploads/product/[[pk]].[[extension]]?t=' . time(),
            ],
            [
                'class'     => '\yiidreamteam\upload\FileUploadBehavior',
                'attribute' => 'preview_image',
                'filePath'  => '@frontend/web/uploads/product/preview_[[pk]].[[extension]]',
                'fileUrl'   => ArrayHelper::getValue(
                        Yii::$app->params,
                        'url.frontend'
                    ) . '/uploads/product/preview_[[pk]].[[extension]]?t=' . time(),
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'info' => 'Info',
            'score_rating' => 'Score Rating',
            'star_rating' => 'Star Rating',
            'link' => 'Link',
            'price' => 'Price',
            'original_price' => 'Original Price',
            'image' => 'Image',
            'pick_label' => 'Pick Label',
            'review' => 'Review',
            'review_count' => 'Count of Reviews',
            'full_features' => 'Full Features',
            'short_features' => 'Short Features',
            'trial' => 'Count of trial days',
            'sort_order' => 'Sort Order',
            'status' => 'Status',
        ];
    }

    /**
     * @return array
     */
    public function getAllCategories()
    {
        return ArrayHelper::map(
            Product::find()->select('category')->groupBy('category')->all(),
            'category',
            'category'
        );
    }

    /**
     * @return string
     */
    public function getPreview()
    {
        if (!empty($this->preview_image)) {
            return $this->getUploadedFileUrl('preview_image');
        }

        return $this->getUploadedFileUrl('image');
    }
}
