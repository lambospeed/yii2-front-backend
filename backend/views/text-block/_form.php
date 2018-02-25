<?php

use common\models\TextBlock;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $this View
 * @var $model TextBlock
 * @var $form ActiveForm
 */
?>

<div class="text-block-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'system_name')->textInput(['maxlength' => true, 'disabled' => true]) ?>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model, 'content')->widget(TinyMce::className(), [
            'options' => ['rows' => 6],
            'clientOptions' => [
                'plugins' => [
                    "advlist autolink lists link charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste",
                    "link  hr"
                ],
                'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            ]
        ]); ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="fa fa-upload"></i> Create') : Yii::t('app', '<i class="fa fa-floppy-o"></i> Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
