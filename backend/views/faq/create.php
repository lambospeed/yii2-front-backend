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

$this->title = 'Add question';
$this->params['breadcrumbs'][] = ['label' => 'FAQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-create">

    <?php
    $items = [];

    /** @var Expansion[] $expansions */
    $expansions = Expansion::find()->all();
    foreach ($expansions as $expansion) {
        $item = [
            'label' => $expansion->code,
            'content' => $this->render(
                '_form',
                [
                    'model' => $model,
                ]
            ),
            'active' => $expansion->default,
            'url' => (!$expansion->default)
                ? '#'
                : Url::to(
                    [
                        Yii::$app->controller->action->id,
                        'id' => $model->id,
                        'expansionId' => $expansion->id,
                    ]
                )
        ];

        if (!$expansion->default) {
            $item['headerOptions'] = ['class' => 'disabled'];
        }

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
