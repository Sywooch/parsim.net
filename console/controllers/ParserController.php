<?php

namespace console\controllers;


use Yii;
use yii\console\Controller;
use common\models\Parser;
//use common\models\parsers\classes\InitParsData;



class ParserController extends Controller
{

    public function actionInit($complete=false){

        Parser::deleteAll();
        Yii::$app->db->createCommand('ALTER SEQUENCE parser_id_seq RESTART WITH 1')->execute();

        $initData=json_decode(file_get_contents(Parser::getClassDir().'InitParsData.json'),true);
        
        //if($complete){
        $mask=Parser::getClassDir().'*.php';
        array_map('unlink', glob($mask));
        //}

        foreach ($initData as $key => $parser) {
            $model = new Parser();

            $model->alias=uniqid();
            $model->type_id=$parser['type_id'];
            $model->name=$parser['name'];
            $model->loader_type=0;
            $model->reg_exp=$parser['reg_exp'];
            $model->example_url=$parser['example_url'];

            $model->testUrls=$parser['testUrls'];
            $model->parsActions=$parser['parsActions'];

            $model->status=0;
            
            $model->save();
        }

    }
  
}