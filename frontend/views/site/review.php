<?php

use common\models\Product;
use frontend\helpers\UiHelper;
use frontend\widgets\DisclaimerWidget;
use frontend\widgets\FeaturedWidget;
use frontend\widgets\TopWidget;
use yii\web\View;

/**
 * @var View $this
 * @var Product $model
 */

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model->meta_keywords
]);

$this->title = $model->title;
?>
<div class="head-info-thin">
    <a href="<?= Yii::$app->request->referrer ?>" class="back-reviews_btn">back to reviews list</a>
    <div class="h1-like"><?= $model->title ?> review</div>
</div>
<div class="s-wide-wrapper">
    <?= DisclaimerWidget::widget() ?>
    <div class="s-main">
        <div class="full-info-block">
            <div class="site__logo">
                <img class="product__logo__img" src="<?= $model->getPreview() ?>" alt="">
            </div>
            <p>
                <?= $model->description ?>
            </p>
            <section>
                <h6>Features</h6>
                <ul>
                    <?= UiHelper::cutListElements($model->full_features) ?>
                </ul>
            </section>
            <div class="visit-note">
                <?php if ($model->info): ?>
                    <p><?= $model->info ?></p>
                <?php endif; ?>
                <a href="<?= $model->link ?>" class="visit-button google-tracking-conversion">Visit site</a>
            </div>

        </div>

        <div class="plain-text-block">
            <?= $model->review ?>
        </div>

        <?php if(!empty($model->bottom_block_title) || !empty($model->bottom_block_content) ) { ?>
        <div class="product__bottom-yellow-block">
            <h3 class="centered-text"><?= $model->bottom_block_title ?></h3>
            <div class="product__bottom-yellow-block__content">
                <?= $model->bottom_block_content ?>
            </div>
        </div>
        <?php } ?>
        <?php if(!empty($model->bottom_block_credit) ) { ?>
        <div class="product__bottom-credit-block">
            <?= $model->bottom_block_credit ?>
        </div>
        <?php } ?>

        <div class="center">
            <a href="<?= $model->link ?>" class="buy-product__btn google-tracking-conversion">Buy now</a>
        </div>
    </div>

    <div class="side-block">
        <?= FeaturedWidget::widget(['model' => $model]) ?>
        <?= TopWidget::widget(['category' => $model->category]) ?>
    </div>
    <div class="clear"></div>

</div>
