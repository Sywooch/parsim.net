<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'layout' => 'content',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'class' => 'common\components\LangRequest',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl'=>'/user/login'
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'class'=>'common\components\LangUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules'=>[
                '/' => 'site/index',
                '<_a:(about|contact)>' => 'site/<_a>',
                '<_a:(login|logout|signup|email-confirm|password-reset-request|password-reset)>' => 'user/<_a>',

                //API rules
                'api/'=>'api/default/index',
                'api/<controller:\w+>/<alias:\w+>/'=>'api/<controller>/view',
                'api/<controller:\w+>/'=>'api/<controller>/index',
                

                '<controller:\w+>/view/<alias:\w+>/'=>'<controller>/view',
                '<controller:\w+>/'=>'<controller>/index',
                '<controller:\w+>/<action:\w+>/'=>'<controller>/<action>',
            ]
        ],
        
    ],
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\Module',
        ],
    ],
    'params' => $params,
];
