<?php

use common\models\Product;
use cozumel\cropper\ImageCropper;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var Product $model
 * @var string $code
 * @var ActiveForm $form
 */

$model->isNewRecord ? $model->status = 1 : null;

$this->registerJs(<<<JS
tinymce.init({
  selector: '.tinymce',
  height: 250,
  plugins: 'visualblocks',
  style_formats: [
    { title: 'Headers', items: [
      { title: 'h1', block: 'h1' },
      { title: 'h2', block: 'h2' },
      { title: 'h3', block: 'h3' },
      { title: 'h4', block: 'h4' },
      { title: 'h5', block: 'h5' },
      { title: 'h6', block: 'h6' }
    ] },

    { title: 'Blocks', items: [
      { title: 'p', block: 'p' },
      { title: 'div', block: 'div' },
      { title: 'pre', block: 'pre' }
    ] },

    { title: 'Containers', items: [
      { title: 'section', block: 'section', wrapper: true, merge_siblings: false },
      { title: 'article', block: 'article', wrapper: true, merge_siblings: false },
      { title: 'blockquote', block: 'blockquote', wrapper: true },
      { title: 'hgroup', block: 'hgroup', wrapper: true },
      { title: 'aside', block: 'aside', wrapper: true },
      { title: 'figure', block: 'figure', wrapper: true }
    ] }
  ],
  visualblocks_default_state: true,
  end_container_on_empty_block: true
 });
JS
);

$this->registerJs(<<<JS
$('#crop_form').on('submit', function (e) {
    var form = $(this);

    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        dataType: 'json',
        data: form.serialize(),
        success: function (data) {
            if (data) {
               //do something
            }
        }
    });
    
    return false;
});
JS
);
?>

<div class="product-form">

    <?php if ( ! $model->isNewRecord) { ?>
        <div class="row">
            <div class="col-lg-1">
                <?=
                Html::a(
                    "Review",
                    Yii::$app->get('urlManagerFrontend')->createAbsoluteUrl([
                        'site/review',
                        'title' => $model->title,
                        'code'  => $code,
                    ]),
                    [
                        'class' => 'btn btn-primary',
                    ]
                )
                ?>
            </div>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-lg-6">
            <?php if (strlen($model->image)): ?>
                <?= ImageCropper::widget([
                    'id'          => 'user_profile_photo',
                    'aspectRatio' => Product::PREVIEW_WIDTH . ":" . Product::PREVIEW_HEIGHT,
                ]); ?>

                <img src="<?= $model->getUploadedFileUrl('image') ?>"
                     class="img img-thumbnail"
                     id="user_profile_photo"
                />
            <?php endif; ?>
        </div>
        <div class="col-lg-6">
            <div style="display: none" id="js_photo_preview">
                <div class="p_2">
                    <div id="js_profile_photo_preview_container"
                         style="position:relative; overflow:hidden; width:<?= Product::PREVIEW_WIDTH ?>px; height:<?= Product::PREVIEW_HEIGHT ?>px; border:1px #000 solid;"
                    >
                        <img width="<?= Product::PREVIEW_WIDTH ?>"
                             height="<?= Product::PREVIEW_HEIGHT ?>"
                             class="border"
                             id="js_profile_photo_preview"
                             src="<?= $model->getUploadedFileUrl('image') ?>"
                        >
                    </div>
                </div>

                <?php
                $form = ActiveForm::begin([
                    'action' => Yii::$app->urlManager->createUrl(['product/save-preview', 'id' => $model->id]),
                    'options' => ['id' => 'crop_form'],
                ]);
                ?>

                <div>
                    <input type="hidden" id="x1" value="" name="x1">
                    <input type="hidden" id="y1" value="" name="y1">
                    <input type="hidden" id="x2" value="" name="x2">
                    <input type="hidden" id="y2" value="" name="y2">
                    <input type="hidden" id="w" value="" name="w">
                    <input type="hidden" id="h" value="" name="h">
                    <input type="hidden" value="<?= Product::PREVIEW_WIDTH ?>" name="image_width">
                    <input type="hidden" value="<?= Product::PREVIEW_HEIGHT ?>" name="image_height">
                </div>

                <div class="form-group">
                    <?= Html::submitButton(
                        '<i class="fa fa-upload"></i> Save Preview',
                        [
                            'class' => 'btn btn-success',
                        ]
                    ) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'image')->fileInput()->label(false) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-1">
            <?= $form->field($model, 'status')->checkbox(['class' => 'checkbox']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'pick_label')->checkbox(['class' => 'checkbox']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'trial')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'review_count')->textInput(['value' => $model->isNewRecord ? 1 : null]) ?>
        </div>
        <div class="col-lg-1">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-1">
            <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-1">
            <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'sort_order')->textInput(['maxlength' => true, 'value' => $model->isNewRecord ? 0 : null]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'category')->widget(
                'kartik\select2\Select2',
                [
                    'model'         => $model,
                    'attribute'     => 'category',
                    'data'          => (new Product())->getAllCategories(),
                    'options'       => [
                        'placeholder' => 'Select category ...',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'tags' => true,
                    ],
                    'value'         => $model->category,
                ]
            )
            ?>
        </div>
        <div class="col-lg-2 col-lg-offset-3">
            <?= $form->field($model, 'original_price')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'score_rating')->textInput() ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'star_rating')->dropDownList(\frontend\helpers\UiHelper::getStarList(), ['3.5' => ['selected' => true]]) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'meta_description')->textInput() ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'meta_keywords')->textInput() ?>
        </div>
    </div>

    <?= $form->field($model, 'full_features')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link preview anchor",
                "searchreplace visualblocks  fullscreen",
                "insertdatetime  contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]); ?>
    <?= $form->field($model, 'short_features')->widget(TinyMce::className(), [
        'options' => ['rows' => 4],
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link preview anchor",
                "searchreplace visualblocks  fullscreen",
                "insertdatetime  contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]); ?>

    <?= $form->field($model, 'review')->textarea(['rows' => 4, 'class' => 'tinymce']) ?>

    <?= $form->field($model, 'bottom_block_title')->textInput() ?>

    <?= $form->field($model, 'bottom_block_content')->widget(TinyMce::className(), [
        'options' => ['rows' => 4],
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link preview anchor",
                "searchreplace visualblocks  fullscreen",
                "insertdatetime  contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]); ?>

    <?= $form->field($model, 'bottom_block_credit')->textarea(['rows' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '<i class="fa fa-upload"></i> Create') : Yii::t('app', '<i class="fa fa-floppy-o"></i> Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
