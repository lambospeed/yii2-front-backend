<?php
/**
 * @var $this yii\web\View
 * @var $models \yii\data\ActiveDataProvider
 */
use common\models\TextBlock;
use common\models\SettingModel;
$this->title = 'True Defense';
$this->registerMetaTag([
    'name' => 'description',
    'content' => SettingModel::getValue(SettingModel::SYSTEM_NAME_INDEX_META_DESC)
]);
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => SettingModel::getValue(SettingModel::SYSTEM_NAME_INDEX_META_KEYWORDS)
]);
?>
<div class="head-info">
    <?= TextBlock::getTextBlock(TextBlock::INDEX_HEADER) ?>
</div>
<div class="wide-wrapper">
    <?= \frontend\widgets\DisclaimerWidget::widget() ?>
    <main>
        <?php if ($models->getCount()): ?>
            <div class="table">
                <div class="table-head-row">
                    <div class="td">Site</div>
                    <div class="td">Score</div>
                    <div class="td">Description</div>
                    <?php if ($priceShow == 1): ?>
                        <div class="td">Price from</div>
                    <?php endif ?>
                    <div class="clear"></div>
                </div>
                <?= $this->render('_product', ['models' => $models, 'priceShow' => $priceShow]) ?>
            </div>
        <?php else: ?>
            <div class="h1-like">We don't have any product</div>
        <?php endif ?>
    </main>

    <div class="side-block">
        <?= \frontend\widgets\FaqWidget::widget() ?>

        <?= \frontend\widgets\ScoreWidget::widget() ?>
    </div>
    <div class="clear"></div>

    <section class="colored-section">
        <article>
            <?= TextBlock::getTextBlock(TextBlock::INDEX_COLORED_LEFT) ?>
        </article>
        <article>
            <?= TextBlock::getTextBlock(TextBlock::INDEX_COLORED_RIGHT) ?>
        </article>
    </section>

    <section class="base-section">
        <?= TextBlock::getTextBlock(TextBlock::INDEX_BASE_BLOCK) ?>
    </section>
</div>
<div class="comments__wrapper">
    <div class="comments">
        <div id="disqus_thread"></div>
        <noscript>Please enable JavaScript to view the
            <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
        </noscript>
        <a href="http://disqus.com" class="dsq-brlink">
            comments powered by <span class="logo-disqus">Disqus</span>
        </a>
    </div>
</div>