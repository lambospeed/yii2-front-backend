<?php

use common\models\Faq;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $this View
 * @var $model Faq
 * @var $form ActiveForm
 */

?>


<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'display')->checkbox() ?>

    <?= $form->field($model, 'question')->textarea(['maxlength' => true, 'rows' => 4]) ?>

    <?= $form->field($model, 'answer')->textarea(['maxlength' => true, 'rows' => 4]) ?>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', '<i class="fa fa-upload"></i> Create') : Yii::t(
                'app',
                '<i class="fa fa-floppy-o"></i> Update'
            ),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
