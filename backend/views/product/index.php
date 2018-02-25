<?php

use backend\models\ProductSearch;
use common\models\Product;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var $this View
 * @var $searchModel ProductSearch
 * @var $dataProvider ActiveDataProvider
 */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <p>
        <?= Html::a('<i class ="fa fa-plus"></i> Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Total Products count {totalCount}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'image',
                'content' => function ($model) {
                    /** @var Product $model */
                    return Html::a(
                        Html::img($model->getPreview(), ['width' => 100]),
                        [
                            'update',
                            'id' => $model->id
                        ]
                    );
                },
                'filter' => false,
                'label' => false,
            ],
            [
                'attribute' => 'title',
                'content' => function ($model) {
                    return Html::a($model->title, ['update', 'id' => $model->id]);

                }
            ],
            'score_rating',
            'star_rating',
            [
                'attribute' => 'price',
                'content' => function ($model) {
                    return Yii::$app->formatter->asCurrency($model->price, $model->currency);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status ? 'Visible' : 'Hidden';
                }
            ],
            'sort_order',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
