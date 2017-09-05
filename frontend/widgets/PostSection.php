<?php
namespace frontend\widgets;


class PostSection extends \yii\bootstrap\Widget
{
    public $model;
    public $limit=3;    

    public function init(){}

    public function run() {
        return $this->render('PostSection/view', [
            'model' => $this->model,
            'limit' => $this->limit
        ]);
    }
}
