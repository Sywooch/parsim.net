<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;

use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class UserController extends Controller
{
    
    public function actionLogin()
    {   
        $this->layout = 'login';
        $model=new LoginForm();
        return $this->render('login',['model'=>$model]);
        
    }

    

    
}
