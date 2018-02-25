<?php

namespace frontend\widgets;

use common\models\TextBlock;
use yii\base\Widget;

/**
 * Class BottomDisclaimerWidget
 * @package frontend\widgets
 */
class BottomDisclaimerWidget extends Widget
{
    public function run()
    {
        $text = TextBlock::getTextBlock(TextBlock::BOTTOM_DISCLAIMER);

        return $this->render('bottom-disclaimer', [
            'text' => $text
        ]);
    }
}
