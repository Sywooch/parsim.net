<?php

namespace frontend\assets\request;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FormTestAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
    ];
    public $js = [
        'js/views/request/_formTest.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
