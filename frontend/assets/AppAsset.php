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
        'css/bootstrap.css',
        'plugins/revolution/css/settings.css',
        'plugins/revolution/css/layers.css',
        'plugins/revolution/css/navigation.css',
        'css/helpers.css',
        'css/style.css',
        'css/responsive.css',
    ];
    
    public $js = [
        //'js/jquery.js',
        'js/bootstrap.min.js',
        
        //Revolution Slider
        'plugins/revolution/js/jquery.themepunch.revolution.min.js',
        'plugins/revolution/js/jquery.themepunch.tools.min.js',
        'plugins/revolution/js/extensions/revolution.extension.actions.min.js',
        'plugins/revolution/js/extensions/revolution.extension.carousel.min.js',
        'plugins/revolution/js/extensions/revolution.extension.kenburn.min.js',
        'plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js',
        'plugins/revolution/js/extensions/revolution.extension.migration.min.js',
        'plugins/revolution/js/extensions/revolution.extension.navigation.min.js',
        'plugins/revolution/js/extensions/revolution.extension.parallax.min.js',
        'plugins/revolution/js/extensions/revolution.extension.slideanims.min.js',
        'plugins/revolution/js/extensions/revolution.extension.video.min.js',
        'js/main-slider-script.js',
        //End Revolution Slider

        '/plugins/notifications/noty.min.js',

        'js/jquery.fancybox.pack.js',
        'js/jquery.fancybox-media.js',
        'js/owl.js',
        'js/wow.js',
        'js/appear.js',
        'js/script.js',
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}

