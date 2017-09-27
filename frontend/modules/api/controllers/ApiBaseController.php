<?php
namespace app\modules\api\controllers;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;



use yii\filters\AccessControl;

//use yii\rest\Controller;
use yii\rest\ActiveController;


//class ApiBaseController extends Controller
class ApiBaseController extends ActiveController
{
    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        return $actions;
    }

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        /*
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                //HttpBasicAuth::className(),
                //HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ]
        ];
        */

        //доступ к API с других доменов
        $behaviors['corsFilter' ] = [
              'class' => \yii\filters\Cors::className(),
        ];

        //утентификация по ключу
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
            'tokenParam' => 'key',
        ];

        //отвеь только в json
        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        
        //права доступа
        $behaviors['access'] = [
            'class' => \yii\filters\AccessControl::className(),
            'only' => ['index','create', 'update', 'delete'],
            'rules' => [
                [
                    'actions' => ['index','create', 'update', 'delete'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];

        return $behaviors;
    }
    
    
}


?>