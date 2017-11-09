<?php

namespace frontend\assets\notification;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
    ];
    public $js = [
        'js/views/notification/index.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
