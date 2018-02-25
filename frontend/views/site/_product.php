<?php

use common\models\Product;
use frontend\helpers\UiHelper;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var $this View
 * @var $models ActiveDataProvider
 * @var $model Product
 */
$i = 0;
?>
<?php foreach ($models->getModels() as $model): ?>
    <div class="table-row table-row-button" data-tracking-url="<?= $model->link ?>">
        <?php if ($model->pick_label): ?>
            <div class="editors-pick__mark"></div>
        <?php endif; ?>
        <div class="td num">#<?= $i = $i + 1 ?></div>
        <div class="td site">
            <div class="site__logo">
                <img class="product__logo__img" src="<?= $model->getPreview() ?>" alt="">
            </div>
            <div class="site__rating js-star-rating" data-rating="<?= $model->star_rating ?>"></div>
            <div class="site__reviews"><?= $model->review_count ?> reviews</div>

        </div>

        <div class="td score">
            <div class="score__value">
                <span class="hidden-name">Our rate</span>
                <?= Yii::$app->formatter->asDecimal($model->score_rating, 1) ?>
            </div>
            <a href="<?=
            Url::to([
                'review',
                'code'  => Yii::$app->get('expansion')->getCode(),
                'title' => $model->title,
            ])
            ?>" class="score__review">View review</a>
        </div>

        <div class="td description">
            <ul class="score-list">
                <?= UiHelper::cutListElements($model->short_features) ?>
            </ul>
            <div class="hide-description__btn closed-v--blue js-hide-description">Show details</div>
        </div>
        <?php if ($priceShow == 1): ?>
            <div class="td price">
                <span class="hidden-name hidden-name__price">Price from</span>
                <div class="price__original">
                    <?php if ( ! empty($model->original_price)) { ?>
                        <?= Yii::$app->formatter->asCurrency($model->original_price, $model->currency) ?>
                    <?php } ?>
                </div>
                <?= Yii::$app->formatter->asCurrency($model->price, $model->currency) ?>
                <sup class="month-sup">/<?= $model->unit ?></sup>
            </div>
            <div class="td button-wpr">
        <?php else: ?>
            <div class="td button-wpr" id="priceHidden">
        <?php endif ?>
            <p class="note--free">
                <?= Yii::$app->formatter->asFreeForPeriod($model->trial) ?>
            </p>
            <a href="<?= $model->link ?>" class="visit-button google-tracking-conversion">Visit site</a>
        </div>
        <div class="clear"></div>
    </div>

<?php endforeach; ?>
