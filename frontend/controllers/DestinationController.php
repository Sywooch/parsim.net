<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\Category;
use common\models\Destination;

//use common\models\searchForms\CategorySearch;

use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class DestinationController extends Controller
{
    

    public function actionIndex($alias=null)
    {

        $model=null;
        //Определяю родительский элемент
        if(isset($alias)){
            $model=$this->findModel($alias);
        }else{
            $model=Destination::findRoot();
        }

        //Условия выборки дочерних элементов
        //все активные направления и места
        $query = Category::find()->where(['type'=>[Category::TYPE_DESTINATION,Category::TYPE_PLACE],'status'=>Category::STATUS_ENABLED]); 
        //Все дочерние элементы
        $query->andWhere(['LIKE','path',$model->path]);
        //за исключением родительского элемента
        $query->andWhere(['NOT',['id'=>$model->id]]); 
        $query ->orderBy(['name'=>SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>21,
            ]
        ]);

        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($alias)
    {
        $model=$this->findModel($alias);    
        return $this->render('view',['model'=>$model]);  
        
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
