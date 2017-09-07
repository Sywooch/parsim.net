<?php

namespace app\modules\api;

use yii\filters\auth\HttpBasicAuth;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }
}
