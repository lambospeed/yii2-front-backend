<?php

use backend\models\Server;
use yii\helpers\Html;
use yii\web\View;


/**
 * @var $this View
 * @var $model Server
 */

$this->title = 'Create Server';
$this->params['breadcrumbs'][] = ['label' => 'Servers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="server-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>
</div>
