<?php

namespace backend\assets\user;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class FormProfileAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/plugins/forms/selects/select2.min.js',
        'js/plugins/forms/styling/uniform.min.js',
        'js/core/libraries/jasny_bootstrap.min.js',
        'js/plugins/forms/styling/switchery.min.js',
        'js/views/user/formProfile.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
}
