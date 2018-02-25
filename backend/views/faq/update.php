<?php

use common\models\Expansion;
use common\models\Faq;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var $this View
 * @var $model Faq
 */

$this->title = 'Update question';
$this->params['breadcrumbs'][] = ['label' => 'FAQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="faq-update">

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
