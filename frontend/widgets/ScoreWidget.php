<?php

namespace frontend\widgets;

use common\models\TextBlock;
use yii\base\Widget;

/**
 * Class ScoreWidget
 * @package frontend\widgets
 */
class ScoreWidget extends Widget
{
    public function run()
    {
        return $this->render(
            'score',
            [
                'list'  => TextBlock::getTextBlock(TextBlock::SCORE_LIST),
                'name'  => TextBlock::getTextBlock(TextBlock::SCORE_NAME),
                'title' => TextBlock::getTextBlock(TextBlock::SCORE_TITLE),
            ]
        );
    }
}
