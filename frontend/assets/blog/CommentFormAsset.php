<?php

namespace frontend\assets\blog;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class CommentFormAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
    ];
    public $js = [
        'js/views/blog/_commentForm.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
