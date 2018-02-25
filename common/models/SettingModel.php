<?php

namespace common\models;

use yii;
use yii\db\ActiveRecord;

/**
 * Class SettingModel
 * @package common\models
 *
 * This is the model class for table "{{%setting}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $system_name
 * @property string $value
 */
class SettingModel extends ActiveRecord
{
    const SYSTEM_NAME_GOOGLE_SOC_LINK = 'g_soc_link';
    const SYSTEM_NAME_TWITTER_SOC_LINK = 'tw_soc_link';
    const SYSTEM_NAME_FACEBOOK_SOC_LINK = 'fb_social_link';
    const SYSTEM_NAME_DISQUS_SHORTNAME = 'disqus_shortname';
    const SYSTEM_NAME_INDEX_META_KEYWORDS = 'index_meta_keywords';
    const SYSTEM_NAME_INDEX_META_DESC = 'index_meta_desc';
    const SYSTEM_NAME_TRACKING_CODE = 'tracking_code';

    public static function tableName()
    {
        return 'setting' . Yii::$app->get('expansion')->getTableSuffix();
    }

    /***
     * @param $systemName
     * @return string
     */
    public static function getValue($systemName)
    {
        $model = static::findOne(['system_name' => $systemName]);
        return $model->value;
    }

    /**
     * @param $systemName
     * @param $newValue
     * @return bool
     */
    public static function changeValue($systemName, $newValue)
    {
        $model = static::findBySystemName($systemName);
        $model->value = $newValue;
        return $model->save(false);
    }

    /**
     * @param string $systemName
     * @return static
     */
    public static function findBySystemName($systemName)
    {
        return static::findOne(['system_name' => $systemName]);
    }

    public function rules()
    {
        return [
            [['name', 'system_name', 'value'], 'required'],
            [['name', 'system_name', 'value'], 'string'],
            [['system_name'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Option',
            'system_name' => 'System Name',
            'value' => 'Value',
        ];
    }
}
