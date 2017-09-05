<?php
namespace frontend\widgets;


class HeroSection extends \yii\bootstrap\Widget
{
    //public $model;
    public $title=false;
    public $subtitle=false;
    public $cssClass='hero destination-header';
    public $breadcrumbs=[];
    public $imgUrl='';

    public function init(){}

    public function run() {
        return $this->render('HeroSection/view', [
            //'model' => $this->model,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'cssClass'=>$this->cssClass,
            'breadcrumbs'=>$this->breadcrumbs,
            'imgUrl'=>$this->imgUrl
        ]);
    }
}
