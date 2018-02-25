<?php

namespace frontend\widgets;

use common\models\Faq;
use frontend\helpers\UiHelper;
use yii\base\Widget;

/**
 * Class FaqWidget
 * @package frontend\widgets
 */
class FaqWidget extends Widget
{
    public function run()
    {
        $models = Faq::find()->where(['display' => UiHelper::TYPE_BOOLEAN_YES])->all();

        return $this->render('faq', ['models' => $models]);
    }
}