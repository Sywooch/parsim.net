<?php
namespace frontend\widgets;
use common\models\Post;


class TopPosts extends \yii\bootstrap\Widget
{
    public $limit=10;
    public $excludeId=[];

    public function init(){}

    public function run() {
        $query=Post::find()->where(['type'=>Post::TYPE_BLOG,'status'=>Post::STATUS_PUBLISHED]);
        $query->limit($this->limit);
        //$query->orderBy(['rate'=>SORT_DESC]);
        $query->andWhere(['NOT',['id'=>$this->excludeId]]);
        return $this->render('TopPosts/view', [
            'items' => $query->all()
        ]);
    }
}
