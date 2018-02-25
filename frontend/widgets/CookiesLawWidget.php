<?php

namespace frontend\widgets;

use common\components\Expansion;
use yii;
use yii\base\Widget;

class CookiesLawWidget extends Widget
{
    public function run()
    {
        /** @var Expansion $expansion */
        $expansion = Yii::$app->get('expansion');

        return (!$expansion->isNeededCookiesLaw()) ? '' : $this->render('cookies-law');
    }
}
