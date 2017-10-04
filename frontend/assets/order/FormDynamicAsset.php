<?php

namespace frontend\assets\order;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FormDynamicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
    ];
    public $js = [
        'js/views/order/_formDynamic.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
