<?php
namespace frontend\widgets;



class RateBox extends \yii\bootstrap\Widget
{
    public $symbol='star';
    public $value=0;
    public $maxValue=5;
    public $cssClass='rating rating-star';

    public function init(){}

    public function run() {
        return $this->render('RateBox/view', [
            'symbol' => $this->symbol,
            'value'=>$this->value,
            'maxValue'=>$this->maxValue,
            'cssClass'=>$this->cssClass,
        ]);
    }
}
