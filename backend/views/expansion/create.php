<?php

use common\models\Expansion;
use yii\helpers\Html;
use yii\web\View;


/**
 * @var $this View
 * @var $model Expansion
 */

$this->title = 'Create Expansion';
$this->params['breadcrumbs'][] = ['label' => 'Expansions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expansion-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>
</div>
