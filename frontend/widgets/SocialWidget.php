<?php

namespace frontend\widgets;

use yii\base\Widget;
use common\models\SettingModel;

class SocialWidget extends Widget
{


    public function run()
    {
        return $this->render('social', [
            'google' => SettingModel::getValue(SettingModel::SYSTEM_NAME_GOOGLE_SOC_LINK),
            'twitter' => SettingModel::getValue(SettingModel::SYSTEM_NAME_TWITTER_SOC_LINK),
            'facebook' => SettingModel::getValue(SettingModel::SYSTEM_NAME_FACEBOOK_SOC_LINK)
        ]);
    }
}