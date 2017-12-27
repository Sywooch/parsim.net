<?php

namespace backend\assets\tarif;

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
        '/js/plugins/forms/styling/uniform.min.js',
        'js/plugins/forms/selects/bootstrap_multiselect.js',
        'js/plugins/forms/selects/select2.min.js',
        'js/plugins/editors/ace/ace.js',
        'js/views/tarif/_form.js'
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
