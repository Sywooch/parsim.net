<?php
namespace backend\widgets;
use common\models\Language;

class LngSelector extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        return $this->render('LngSelector/view', [
            'current' => Language::getCurrent(),
            'langs' => Language::find()->where('id != :current_id', [':current_id' => Language::getCurrent()->id])->all(),
        ]);
    }
}
