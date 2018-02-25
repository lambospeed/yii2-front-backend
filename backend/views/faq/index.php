<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FAQ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">
    <p>
        <?= Html::a('<i class ="fa fa-plus"></i> Add question', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => 'Total Questions count {totalCount}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'question',
                'content' => function ($model) {
                    return Html::a(\yii\helpers\StringHelper::truncateWords($model->question, 7), ['update', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'answer',
                'content' => function ($model) {
                    return Html::a(\yii\helpers\StringHelper::truncateWords($model->answer, 7), ['update', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => 'display',
                'filter' => \frontend\helpers\UiHelper::getBooleanLabels('Виден', 'Скрыт'),
                'filterInputOptions' => ['prompt' => 'Choose'],
                'content' => function ($model) {
                    return $model->display ? 'Visible' : 'Hidden';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => "{update}{delete}"
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
