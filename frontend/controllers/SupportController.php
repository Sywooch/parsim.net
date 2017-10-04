<?php

namespace frontend\controllers;

use Yii;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * OrderController implements the CRUD actions for order model.
 */
class SupportController extends Controller
{

    
    /**
     * Lists all order models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
