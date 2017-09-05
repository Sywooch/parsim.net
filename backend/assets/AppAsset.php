<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900',
        'css/icons/icomoon/styles.css',
        'css/bootstrap.css',
        'css/core.css',
        'css/components.css',
        'css/colors.css',
        'css/style.css',
    ];
    public $js = [
        'js/plugins/loaders/pace.min.js',
        //'js/core/libraries/jquery.min.js',
        'js/core/libraries/bootstrap.min.js',
        'js/plugins/loaders/blockui.min.js',
        'js/core/app.js',
        'js/plugins/ui/ripple.min.js',

        'js/plugins/forms/styling/uniform.min.js',
        'js/plugins/forms/styling/switchery.min.js',
        'js/plugins/forms/styling/switch.min.js',
        'js/plugins/forms/selects/select2.min.js',

        //'js/plugins/pickers/pickadate/picker.js',
        //'js/plugins/pickers/pickadate/picker.date.js',
        //'js/plugins/pickers/pickadate/picker.time.js',
        //'js/plugins/pickers/color/spectrum.js',

        'js/plugins/media/fancybox.min.js',


        //'js/plugins/media/cropper.min.js',

        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
