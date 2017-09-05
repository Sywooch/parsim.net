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
            'class' => 'common\components\LangRequest'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
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


                
                'destination/<alias>'=>'destination/view',
                'destinations/<alias>'=>'destination/index',
                'destinations'=>'destination/index',


                //'travel-category/<destination>/<categoty>'=>'explore/index',
                'travel-category/<alias>'=>'explore/view',
                'travel-category/'=>'explore/index',


                'articles/<destination:\w+>'=>'blog/index',
                'articles/'=>'blog/index',
                'articles/author/<author>'=>'blog/author',
                'articles/tag/<tag:\w+>'=>'blog/tag',
                'articles/<alias>'=>'blog/view',


                'places/<destination>'=>'place/index',
                'place/<alias>'=>'place/view',


                'listings/<destination>/<categoty>'=>'direction/index',
                'listings/<destination>'=>'direction/index',

                'information/<destination>/<categoty>'=>'information/index',
                'information/<destination>'=>'information/index',

                '<controller:\w+>/view/<alias:\w+>/'=>'<controller>/view',
                '<controller:\w+>/'=>'<controller>/index',
                '<controller:\w+>/<action:\w+>/'=>'<controller>/<action>',
            ]
        ],
    ],
    'params' => $params,
];
