<?php

use common\models\ExpansionSearch;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var $this View
 * @var $searchModel ExpansionSearch
 * @var $dataProvider ActiveDataProvider
 */

$this->title = 'Expansions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expansion-index">
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Create Expansion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'export' => false,
            'summary' => 'Total Expansions count {totalCount}',
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                    'attribute' => 'title',
                    'content' => function ($model) {
                        return Html::a($model->title, ['update', 'id' => $model->id]);

                    }
                ],
                'code',
                [
                    'class'     => 'kartik\grid\DataColumn',
                    'attribute' => 'code',
                    'label'     => 'Preview',
                    'format'    => 'raw',
                    'value'     => function ($model, $key, $index, $column) {
                        $url = Yii::$app->params['url.frontend'] . $model->code;

                        return Html::a($url, $url);
                    }
                ],
                'countries',
                [
                    'class' => 'kartik\grid\BooleanColumn',
                    'attribute' => 'price',
                ],
                [
                    'class' => 'kartik\grid\BooleanColumn',
                    'attribute' => 'default',
                ],
                [
                    'class' => 'kartik\grid\BooleanColumn',
                    'attribute' => 'need_cookies_law',
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{update}{delete}',
                ],
            ],
        ]
    ); ?>
    <?php Pjax::end(); ?>
</div>
