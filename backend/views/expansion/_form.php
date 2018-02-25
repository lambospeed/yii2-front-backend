<?php

use common\models\Expansion;
use dpodium\yii2\geoip\components\GeoIP;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $this View
 * @var $model Expansion
 * @var $form ActiveForm
 */
?>

<div class="expansion-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'price')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'default')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'need_cookies_law')->checkbox() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?=
            Select2::widget(
                [
                    'model' => $model,
                    'attribute' => 'country',
                    'data' => array_combine(
                        GeoIP::$COUNTRY_CODES,
                        GeoIP::$COUNTRY_NAMES
                    ),
                    'options' => [
                        'placeholder' => 'Select a countries ...',
                        'multiple' => true,
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'value' => $model->country,
                ]
            )
            ?>
        </div>
    </div>

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
