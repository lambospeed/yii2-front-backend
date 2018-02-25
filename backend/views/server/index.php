<?php

use backend\models\ServerSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var $this View
 * @var $searchModel ServerSearch
 * @var $dataProvider ActiveDataProvider
 */

$this->title = 'Servers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-index">
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Create Server', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'summary' => 'Total Servers count {totalCount}',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'title',
                    'content' => function ($model) {
                        return Html::a($model->title, ['update', 'id' => $model->id]);

                    }
                ],
                'user',
                'host',
                'path',
                'state',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{sync}{update}{delete}',
                    'buttons' => [
                        'sync' => function ($url, $model) {
                            return Html::a(
                                '<span class="fa fa-exchange"></span>',
                                [
                                    'sync',
                                    'id' => $model->id
                                ]
                            );
                        },
                    ],
                ],
            ],
        ]
    ); ?>
    <?php Pjax::end(); ?>
</div>
