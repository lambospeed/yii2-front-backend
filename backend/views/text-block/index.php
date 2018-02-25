<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 */

$this->title = 'Text Blocks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-block-index">
    <?php Pjax::begin(); ?>    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'summary' => 'Total count of blocks {totalCount}',
            'columns' => [
                [
                    'attribute' => 'name',
                    'content' => function ($model) {
                        return Html::a($model->name, ['update', 'id' => $model->id]);
                    },

                ],
                [
                    'attribute' => 'content',
                    'content' => function ($model) {
                        return Html::a(
                            \yii\helpers\StringHelper::truncateWords(strip_tags($model->content), 15),
                            ['update', 'id' => $model->id]
                        );
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}',
                ],
            ],
        ]
    ); ?>
    <?php Pjax::end(); ?>
</div>

