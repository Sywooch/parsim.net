<?php
namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class SiteController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }



    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionError()
    {
        $this->layout = 'column1';
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $statusCode = $exception->statusCode;
            $name = $exception->getName();
            $message = $exception->getMessage();

            return $this->render('error', [
                'exception' => $exception,
                'statusCode' => $statusCode,
                'name' => $name,
                'message' => $message
            ]);
        }
    }
    
}
