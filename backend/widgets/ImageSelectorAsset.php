<?php

namespace backend\widgets;

use yii\web\AssetBundle;

class ImageSelectorAsset extends AssetBundle
{
    public $sourcePath = '@backend/widgets/views/ImageSelector/assets';
    public $css = [
        'imageSelector.css',
    ];
    public $js = [
        'imageSelector.js',
    ];
    public $depends = [
        'backend\assets\AppAsset',
    ];
    
}
