<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class TarifController extends Controller
{
    public $layout = 'column2';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['activate'],
                'rules' => [
                    [
                        'actions' => ['activate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ],
            ]
        ];
    }
    
    

    public function actionActivate($id)
    {
        
        $user=Yii::$app->user->identity;
        if($user->tarif_id!=$id){
            $user->tarif_id=$id;    
            $user->save();
        }else{

        }
        
        return $this->redirect(['/site/index','#'=>'tarif']);
    }

    


    protected function findModel($alias)
    {
        if (($model = Ticket::findOne(['alias'=>$alias])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
