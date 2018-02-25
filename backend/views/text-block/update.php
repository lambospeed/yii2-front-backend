<?php

use common\models\Expansion;
use common\models\TextBlock;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var $this View
 * @var $model TextBlock
 */

$this->title = 'Update: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Text Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="text-block-update">
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
