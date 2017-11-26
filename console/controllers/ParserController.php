<?php

namespace console\controllers;


use Yii;
use yii\console\Controller;
use common\models\Parser;
use common\models\parsers\classes\ParserInitData;



class ParserController extends Controller
{

    public function actionInit(){

        Parser::deleteAll();
        Yii::$app->db->createCommand('ALTER SEQUENCE parser_id_seq RESTART WITH 1')->execute();
        

        foreach (ParserInitData::getInitData() as $key => $parser) {
            $model = new Parser();

            $model->alias=uniqid();
            $model->type_id=$parser['type_id'];
            $model->name=$parser['name'];
            $model->loader_type=0;
            $model->reg_exp=$parser['reg_exp'];
            $model->example_url=$parser['example_url'];
            $model->status=0;
            $model->save();
        }

    }
  
}