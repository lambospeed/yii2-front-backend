<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-model-index">

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Total count of settings {totalCount}',
        'columns' => [
            [
                'attribute' => 'name',
                'content' => function ($model) {
                    return Html::a($model->name, ['update', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'value',
                'content' => function ($model) {
                    return Html::a($model->value, ['update', 'id' => $model->id]);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update}",
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
