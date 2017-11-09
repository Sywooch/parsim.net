<?php
namespace frontend\widgets;


class UserMenu extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        return $this->render('UserMenu/view');
    }
}
