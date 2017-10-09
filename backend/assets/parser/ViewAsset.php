<?php

namespace backend\assets\parser;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ViewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
    ];
    public $js = [
        'js/views/parser/view.js'
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
