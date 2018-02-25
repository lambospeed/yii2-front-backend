<?php

use common\models\Expansion;
use common\models\Product;
use kartik\tabs\TabsX;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var $this View
 * @var $model Product
 */

$this->title = 'Update Product: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $items = [];

    /** @var Expansion[] $expansions */
    $expansions = Expansion::find()->all();
    foreach ($expansions as $expansion) {
        $item = [
            'label' => $expansion->code,
            'content' => (Yii::$app->request->get('expansionId', 1) != $expansion->id)
                ? '<!-- this is content of nonactive tab -->'
                : $this->render(
                    '_form',
                    [
                        'model' => $model,
                        'code' => $expansion->code,
                    ]
                ),
            'active' => Yii::$app->request->get('expansionId', 1) == $expansion->id,
            'url' => Url::to(
                [
                    Yii::$app->controller->action->id,
                    'id' => $model->id,
                    'expansionId' => $expansion->id,
                ]
            )
        ];

        $items[] = $item;
    }
    ?>

    <?= TabsX::widget(
        [
            'items' => $items,
            'position' => TabsX::POS_ABOVE,
            'encodeLabels' => false
        ]
    ) ?>

</div>
