<?php


namespace frontend\helpers;

use frontend\assets\AppAsset;
use yii\base\Component;

class UiHelper extends Component
{
    const TYPE_BOOLEAN_NO = 0;
    const TYPE_BOOLEAN_YES = 1;


    public static function cutListElements($list)
    {
        return strip_tags($list, '<li>');
    }

    /**
     * @param $yes
     * @param $no
     * @return array
     */
    public static function getBooleanLabels($yes, $no)
    {
        return [
            static::TYPE_BOOLEAN_YES => $yes,
            static::TYPE_BOOLEAN_NO => $no,
        ];
    }

    /**
     * returns a path to markup
     * @param $path
     * @return string
     */
    public static function getAssetUrl($path)
    {
        return \Yii::$app->assetManager->getBundle(AppAsset::className())->baseUrl . $path;
    }

    public static function getStarList()
    {
        $result = [];
        for ($i = 0; $i <= 5; $i += 0.5) {
            $a = $i;
            $result[(string)$a] = $a;
        }
        return $result;
    }
}