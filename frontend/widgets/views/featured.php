<?php
/**
 * @var $this yii\web\View
 * @var $model common\models\Product
 */
?>

<aside class="featured-prod">
    <div class="aside__title">
        Featured product
    </div>

    <div class="featured-item">
        <div class="product__logo">
            <img class="product__logo__img" src="<?= $model->getPreview() ?>" alt="">
        </div>
        <a href="<?= $model->link ?>" class="buy-product__btn google-tracking-conversion">Buy now</a>
        <?php if ($priceShow == 1): ?>
        <div class="product__price">
            <div class="product__price__original">
                <?php if ( ! empty($model->original_price)) { ?>
                    <?= Yii::$app->formatter->asCurrency($model->original_price, $model->currency) ?>
                <?php } ?>
            </div>
            <?= Yii::$app->formatter->asCurrency($model->price, $model->currency) ?>
            <sup class="month-sup">/<?= $model->unit ?></sup>
        </div>
        <?php endif ?>
        <div class="product__rating js-star-rating" data-rating="<?= $model->star_rating ?>"></div>
    </div>

</aside>
