<?php

namespace backend\assets\tarif;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'js/plugins/notifications/sweet_alert.min.js',
        'js/plugins/visualization/d3/d3.min.js',
        'js/plugins/visualization/d3/d3_tooltip.js',
        'js/plugins/forms/styling/switchery.min.js',
        'js/plugins/forms/styling/uniform.min.js',
        'js/plugins/forms/selects/bootstrap_multiselect.js',
        'js/plugins/ui/moment/moment.min.js',
        'js/plugins/pickers/daterangepicker.js',
        
        'js/views/site/index.js',
    ];

    public $depends = [
        'backend\assets\AppAsset',
    ];
}

