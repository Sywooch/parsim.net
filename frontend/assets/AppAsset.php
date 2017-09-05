<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/imports.css',
        'css/bootstrap.min.css',
        'css/owl-carousel.css',
        'css/custom.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/owl.carousel.min.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}

