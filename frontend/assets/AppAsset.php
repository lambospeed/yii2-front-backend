<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@frontend/markup/dist';

    public $css = [
        'css/cssreset-min.css',
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',
        'https://fonts.googleapis.com/css?family=Montserrat',
        'libs/star-rating/dist/css/star-rating-svg.css',
        'css/hamburgers.css',
        'app/css/style.css',
        'css/custom.css',
        'css/jquery-ui.css',
    ];
    public $js = [
        'js/jquery-ui.js',
        'js/custom.js',
        'js/common.js',
        'libs/star-rating/dist/jquery.star-rating-svg.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
    public $publishOptions = [
        'except' => [
            'node_modules'
        ],
    ];
}
