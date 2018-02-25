<?php

use common\models\Expansion;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model Expansion
 */

$this->title = 'Update Expansion: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Expansions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expansion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>

</div>
