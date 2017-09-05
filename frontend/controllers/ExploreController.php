<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\TravelCategory;
use common\models\Category;

use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class ExploreController extends Controller
{
    
    public function actionIndex()
    {

        $model=TravelCategory::findRoot();

        //Условия выборки дочерних элементов
        //все активные типы отдыха
        $query = TravelCategory::find()->where(['type'=>[Category::TYPE_EXPLORE],'status'=>Category::STATUS_ENABLED]); 
        //за исключением родительского элемента
        $query->andWhere(['NOT',['id'=>$model->id]]); 
        $query ->orderBy(['name'=>SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($alias)
    {
        $model=$this->findModel($alias); 
        
        $query = Category::find()->where(['category.type'=>[Category::TYPE_DESTINATION,Category::TYPE_PLACE],'category.status'=>Category::STATUS_ENABLED,'explore.alias'=>$alias]); 
        $query->joinWith(['categories explore']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('view',[
            'model'=>$model,
            'dataProvider'=>$dataProvider
        ]);  
        
    }

    protected function findModel($alias)
    {
        if (($model = TravelCategory::findByAlias($alias)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
