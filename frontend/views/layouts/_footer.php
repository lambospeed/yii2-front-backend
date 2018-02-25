<?php

use frontend\widgets\BottomDisclaimerWidget;
use frontend\widgets\SocialWidget;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 */

?>
<footer>
    <div class="thin-wrapper">
        <?= BottomDisclaimerWidget::widget() ?>
        <?= SocialWidget::widget() ?>
        <ul class="nav-anchors">
            <li><a class="btn-terms" href="#">Terms of service</a></li>
            <li>
                <a class="btn-privacy" href="<?=
                Url::to([
                    'site/privacy-policy',
                    'code' => Yii::$app->get('expansion')->getCode(),
                ])
                ?>">Privacy Policy</a>
            </li>
        </ul>
        <div class="copyright">
            <p>Copyright © <?= date('Y') ?> True Defense. All rights reserved.</p>
        </div>
    </div>
</footer>