<?php

use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var string $text
 */

?>

<div class="cookie-law hidden">
    <div class="cookie-law__left">
        This website uses cookies to ensure you get the best experience on our website.
        <a target="_blank" href="<?=
        Url::to([
            'site/privacy-policy',
            'code' => Yii::$app->get('expansion')->getCode(),
        ])
        ?>">Learn more</a>
    </div>
    <div class="cookie-law__right">
        <button class="cookie-law__button">Got it!</button>
    </div>
</div>
