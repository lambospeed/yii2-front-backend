<?php
/**
 * @var $models \common\models\Faq[]
 *
 *
 */
?>

<aside class="faq">
    <div class="aside__title">
        Faq
    </div>
    <?php foreach ($models as $model): ?>
        <div class="aside__item">
            <p class="aside-item__name js-open-sibling closed"><?= $model->question ?></p>
            <p class="aside-item__text"><?= $model->answer ?></p>
        </div>
    <?php endforeach; ?>

</aside>
