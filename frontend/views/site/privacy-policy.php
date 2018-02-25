<?php

use common\models\TextBlock;
use yii\web\View;

/**
 * @var View $this
 */
?>

<div class="head-info-thin">
    <a href="<?= Yii::$app->request->referrer ?>" class="back-reviews_btn">back to reviews list</a>
    <div class="h1-like">Privacy Policy</div>
</div>
<div class="wide-wrapper">
    <div class="plain-text-block">
        <?= TextBlock::getTextBlock(TextBlock::PRIVACY_POLICY) ?>
    </div>
</div>
