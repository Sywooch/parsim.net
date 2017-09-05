<?php
namespace frontend\widgets;
use common\models\Destination;

class TopDestinations extends \yii\bootstrap\Widget
{
    public $limit=10;
    public function init(){}

    public function run() {
        $query=Destination::find()->where(['type'=>Destination::TYPE_DESTINATION,'status'=>Destination::STATUS_ENABLED]);
        $query->limit($this->limit);
        $query->orderBy(['rate'=>SORT_DESC]);
        $query->andWhere(['NOT',['parent_id'=>null]]);
        return $this->render('TopDestinations/view', [
            'items' => $query->all()
        ]);
    }
}
