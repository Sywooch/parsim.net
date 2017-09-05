<?php
namespace frontend\widgets;


class IntroSection extends \yii\bootstrap\Widget
{
    public $model;
   

    public function init(){}

    public function run() {
        return $this->render('IntroSection/view', [
            'model' => $this->model,
        ]);
    }
}
