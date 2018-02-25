<?php
/**
 * Created by PhpStorm.
 * User: voshkin
 * Date: 21.12.16
 * Time: 16:24
 */


namespace frontend\widgets;

use common\models\TextBlock;
use yii\base\Widget;

class DisclaimerWidget extends Widget
{
    public function run()
    {
        $text = TextBlock::getTextBlock(TextBlock::DISCLAIMER_TEXT);

        return $this->render('disclaimer', [
            'text' => $text
        ]);
    }
}