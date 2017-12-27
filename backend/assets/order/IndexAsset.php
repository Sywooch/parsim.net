<?php

namespace backend\assets\order;

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
        'js/views/order/index.js',
        'js/plugins/notifications/sweet_alert.min.js'
    ];

    public $depends = [
        'backend\assets\AppAsset',
    ];
}
