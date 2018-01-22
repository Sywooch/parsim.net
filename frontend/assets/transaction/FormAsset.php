<?php

namespace frontend\assets\transaction;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FormAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
    ];
    public $js = [
        'js/views/transaction/_form.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
