<aside class="main-sidebar">

    <section class="sidebar">
        <?= \dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Products', 'icon' => 'fa fa-product-hunt', 'url' => ['/product/index']],
                    ['label' => 'FAQ', 'icon' => 'fa fa-question', 'url' => ['/faq/index']],
                    ['label' => 'Settings', 'icon' => 'fa fa-gear', 'url' => ['/setting/index']],
                    ['label' => 'Text Blocks', 'icon' => 'fa fa-file-text-o', 'url' => ['/text-block/index']],
                    ['label' => 'Servers', 'icon' => 'fa fa-server', 'url' => ['/server/index']],
                    ['label' => 'Expansions', 'icon' => 'fa fa-map', 'url' => ['/expansion/index']],
                    ['label' => 'Clear cache', 'icon' => 'fa fa-cubes', 'url' => ['/cache/clear']],
                ],
            ]
        ) ?>
    </section>

</aside>
