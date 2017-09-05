<?php
namespace frontend\widgets;


class SubNavigation extends \yii\bootstrap\Widget
{
    public $model;
    public function init(){}

    public function run() {
        return $this->render('SubNavigation/view', [
            'model' => $this->model,
        ]);
    }
}
