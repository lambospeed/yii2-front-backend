<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%expansion}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property boolean $default
 * @property string $countries
 * @property boolean $need_cookies_law
 * @property boolean $price
 * @property string[] $country
 */
class Expansion extends ActiveRecord
{
    const DELIMITER = ', ';

    public $country = [];

    public static function tableName()
    {
        return '{{%expansion}}';
    }

    public function afterFind()
    {
        $this->country = explode(static::DELIMITER, $this->countries);
        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        $this->countries = implode(static::DELIMITER, $this->country);
        return parent::beforeSave($insert);
    }

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'code',
                ],
                'required'
            ],
            [
                'countries',
                'string',
            ],
            [
                'country',
                'each',
                'rule' => [
                    'string',
                ],
            ],
            [
                [
                    'default',
                    'price',
                    'need_cookies_law',
                ],
                'boolean',
            ],
            [
                [
                    'title',
                    'code',
                ],
                'filter',
                'filter' => 'trim'
            ],
            [
                [
                    'title',
                    'code',
                ],
                'string',
                'max' => 255
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'code' => 'Code',
            'price' => 'Price',
            'default' => 'Default',
        ];
    }
}
