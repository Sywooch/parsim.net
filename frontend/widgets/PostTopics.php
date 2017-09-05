<?php
namespace frontend\widgets;
use common\models\Category;


class PostTopics extends \yii\bootstrap\Widget
{
    public $limit=5;
    //public $excludeId=[];

    public function init(){}

    public function run() {
        $query=Category::find()->where(['type'=>[
            Category::TYPE_EXPLORE,
            Category::TYPE_PLACE,
            //Category::TYPE_INFORMATION,
            ],
            'status'=>Category::STATUS_ENABLED
        ]);
        $query->limit($this->limit);
        $query->orderBy(['rate'=>SORT_DESC]);
        //$query->andWhere(['NOT',['id'=>$this->excludeId]]);
        return $this->render('PostTopics/view', [
            'items' => $query->all()
        ]);
    }
}
