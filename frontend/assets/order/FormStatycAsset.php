<?php

namespace frontend\assets\order;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FormStatycAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
    ];
    public $js = [
        'js/views/order/_formStatyc.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
