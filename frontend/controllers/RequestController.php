<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ContactForm;


/**
 * Site controller
 */
class RequestController extends Controller
{
    
    
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionView($alias)
    {
        return $this->render('view',[
        ]);
    }

    
}
