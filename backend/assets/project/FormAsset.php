<?php

namespace backend\assets\project;

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
        //'js/plugins/editors/summernote/summernote.min.js',
        //'js/views/orgunit/_form.js'
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
