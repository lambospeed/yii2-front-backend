<?php

namespace common\components;

use yii;

/**
 * Class Formatter
 * @package common\components
 */
class Formatter extends yii\i18n\Formatter
{
    public function asFreeForPeriod($trial)
    {
        if (empty($trial)) {
            return '';
        }

        return "<b>" . $trial . " Day</b> FREE TRIAL";
    }
}
