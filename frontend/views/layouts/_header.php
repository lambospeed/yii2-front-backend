<?php

use yii\widgets\Menu;

?>
<header>
    <a href="<?= Yii::$app->homeUrl ?>" class="logo">
        <span class="logo__name"></span>True Defense
        <span class="logo--sm">Trusted Expert Reviews</span>
    </a>
    <?= Menu::widget([
        'options' => [
            'class' => 'main-nav right hidden',
        ],
        'items' => [
            ['label' => 'Option 1', 'url' => '#'],
            ['label' => 'Option 2', 'url' => '#'],
            ['label' => 'Option 3', 'url' => '#'],

        ],
    ]) ?>
    <div class="hamburger hamburger--squeeze right">
          <span class="hamburger-box">
            <span class="hamburger-inner"></span>
          </span>
    </div>
</header>