<?php
namespace frontend\widgets;


class DirectSection extends \yii\bootstrap\Widget
{
    public $model;
    public $limit=6;    

    public function init(){}

    public function run() {
        return $this->render('DirectSection/view', [
            'model' => $this->model,
            'limit' => $this->limit
        ]);
    }
}
