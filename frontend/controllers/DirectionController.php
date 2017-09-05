<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

use common\models\Destination;
use common\models\Direction;
use common\models\Orgunit;
use yii\web\BadRequestHttpException;


/**
 * Site controller
 */
class DirectionController extends Controller
{
    
    
    public function actionIndex($destination,$categoty=null)
    {

        $sort_types=[
            'asc'=>'ASC',
            'desc'=>'DESC',
        ];

        $sort_fields=[
            'quality'=>'orgunit.rate_quality',
            'price'=>'orgunit.rate_price',
        ];

        $sort=Yii::$app->request->get('sort','quality_asc');
        $sortArray=explode('_', $sort);


        $model=$this->findModel($destination);
        if(!isset($categoty)){
            $directions=$model->directions;
            if (count($directions)>0){
                $categoty=$directions[0]->alias;
            }else{
                $categoty='services';
            }
            
        }
        $direction=$this->findDirection($categoty);

        $query = Orgunit::find()->where(['orgunit.category_id'=>$direction->id,'orgunit.status'=>Orgunit::STATUS_PUBLISHED]); 
        $query->joinWith(['location location']);
        $query->andFilterWhere(['like', 'location.path', $model->path]);
        $query->orderBy($sort_fields[$sortArray[0]].' '.$sort_types[$sortArray[1]]);
        
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>21,
            ]
        ]);

        
        return $this->render('index',[
            'model'=>$model, //место
            'categoty'=>$categoty, //категория организации. статьи (Activities,Attractions,Food & Drinks и т.д.)
            'dataProvider'=>$dataProvider, //все организации заданной категории по текущей и дочерним локациям
            'sort'=>$sort,
        ]);  
        
    }

    public function actionView($id)
    {

        $model=$this->findOrgunit($id);
        $destination=$this->findModel($model->location->alias);
        
        return $this->render('view',[
            'model'=>$model,
            'destination'=>$destination

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

    protected function findDirection($alias)
    {
        if (($model = Direction::findByAlias($alias)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findOrgunit($id)
    {
        if (($model = Orgunit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
}
