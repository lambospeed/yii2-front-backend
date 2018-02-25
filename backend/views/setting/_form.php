<?php

use common\models\SettingModel;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $this View
 * @var $model SettingModel
 * @var $form ActiveForm
 */
?>

<div class="setting-model-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-4">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($model, 'system_name')->textInput(['maxlength' => true, 'disabled' => true]) ?>
    </div>
    <div class="col-lg-12">
        <?= $form->field($model, 'value')->textarea(['rows' => 20]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord
                ? Yii::t('app', '<i class="fa fa-upload"></i> Create')
                : Yii::t(
                'app',
                '<i class="fa fa-floppy-o"></i> Update'
            ),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
