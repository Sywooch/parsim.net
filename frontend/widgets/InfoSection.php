<?php
namespace frontend\widgets;


class InfoSection extends \yii\bootstrap\Widget
{
    public $model;
    public $limit=5;    

    public function init(){}

    public function run() {
        return $this->render('InfoSection/view', [
            'model' => $this->model,
            'limit' => $this->limit
        ]);
    }
}
