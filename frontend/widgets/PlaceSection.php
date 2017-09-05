<?php
namespace frontend\widgets;


class PlaceSection extends \yii\bootstrap\Widget
{
    public $model;
    public $limit=2;    

    public function init(){}

    public function run() {
        return $this->render('PlaceSection/view', [
            'model' => $this->model,
            'limit' => $this->limit
        ]);
    }
}
