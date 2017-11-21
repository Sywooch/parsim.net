<?php
namespace app\modules\api\controllers;

use Yii;
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
        return $actions;
    }

    

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        //доступ к API с других доменов
        $behaviors['corsFilter' ] = [
              'class' => \yii\filters\Cors::className(),
        ];

        //аутентификация по ключу
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
        
        /*
        $behaviors['verbs'] = [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' => [
                'index'  => ['get'],
                'view'   => ['get'],
                'create' => ['post'],
                'update' => ['put'],
                'delete' => ['delete'],
            ],
        ];
        */

        //права доступа
        $behaviors['access'] = [
            'class' => \yii\filters\AccessControl::className(),
            'only' => ['index','create', 'update', 'delete','view'],
            'rules' => [
                [
                    'actions' => ['index','create', 'update', 'delete','view'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];

        /*
        public function checkAccess($action, $model = null, $params = [])
        {
            // проверяем может ли пользователь редактировать или удалить запись
            // выбрасываем исключение ForbiddenHttpException если доступ запрещен
            if ($action === 'update' || $action === 'delete') {
                if ($model->user_id !== \Yii::$app->user->id)
                    throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s lease that you\'ve created.', $action));
            }
        }
        */

        return $behaviors;
    }

    public function makeError($code,$msg)
    {   
        Yii::$app->response->statusCode = $code;
        return ['errorCode'=>$code,'errorMessage'=>$msg];
    }
    
    
}




?>