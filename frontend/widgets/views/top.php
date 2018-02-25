<?php

use common\models\Product;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var $this View
 * @var $models Product[]
 */

?>

<aside class="top-items">
    <div class="aside__title">
        Top 5 software
    </div>
    <?php foreach ($models as $model): ?>
        <div class="top-item">
            <div class="top-site"
                 style="background-image: url(<?= $model->getPreview() ?>)"></div>
            <div class="score__value hide-param">
                <?= $model->score_rating ?>
                <span>Our score</span>
            </div>
            <a href="<?= $model->link ?>" class="visit-button--sm google-tracking-conversion">Visit site</a>
            <a href="<?= Url::to(['review', 'title' => $model->title]) ?>" class="score__review">View review</a>
        </div>
    <?php endforeach; ?>
</aside>
