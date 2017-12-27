<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


/**
 * Site controller
 */
class BackendController extends Controller
{
    
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
                        'actions' => ['index','view','delete','test'],
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
    

    public function getMsgData($type,$title,$text){
        

        $confirmButtonColors=[
            'success'=>'#66BB6A',
            'error'=>'#EF5350',
            'warning'=>'#FF7043',
            'info'=>'#2196F3',
        ];
        

        $msg=[
            'type'=>$type,
            'title'=>$title,
            'text'=>$text,
            'confirmButtonColor'=>$confirmButtonColors[$type],
        ];
        return $msg;
    }
    

}
