<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Destination;
use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class InformationController extends Controller
{
    
    public function actionIndex($destination,$categoty='about')
    {
        $model=$this->findModel($destination);
        return $this->render('index',[
            'model'=>$model, //место
            'categoty'=>$categoty, //категория инфо. статьи (about,Events,Getting Around и т.д.)
        ]);  
        
    }

    protected function findModel($alias)
    {
        if (($model = Destination::findByAlias($alias)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
