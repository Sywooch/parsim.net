<?php
namespace frontend\widgets;


class BannerViewer extends \yii\bootstrap\Widget
{
    
    public function init(){}

    public function run() {
        return $this->render('BannerViewer/view', [
          //'model' => $this->model,
          //'limit' => $this->limit
        ]);
    }
}
