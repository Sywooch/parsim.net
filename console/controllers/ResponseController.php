<?php

namespace console\controllers;


use Yii;
use yii\console\Controller;
use common\models\Request;
use common\models\Response;

use common\models\parsers\classes\HTMLLoader;
use common\models\parsers\classes\BaseParser;


class ResponseController extends Controller
{

    public function actionUpdate(){

        //Обновляю статус запросов для которых настало время обновить инфо
        $requests=Request::find()->where([
            'status'=>Request::STATUS_SUCCESS,
        ]);
        $requests->andWhere('(extract(epoch from now())-updated_at)/60 >= sleep_time');
        
        foreach ($requests->all() as $key => $request) {
            //$request->addResponse();
             $request->status=Request::STATUS_READY;
             $request->save();
        }

        //Создаю новые ответы для запросов в статусе READY
        //Это запросы для которых настало время обновить информацию
        $requests=Request::find()->where(['status'=>[Request::STATUS_READY]])->all();
        
        foreach ($requests as $key => $request) {
            //Создаю новый ответ
            $request->addResponse();
        }

        //Загрузка контента htmlClient
        $responses=Response::find()->where(['status'=>Response::STATUS_READY])->all();
        foreach ($responses as $key => $response){
            
            $request=$response->request;
            $content_path=$response->contentPath;

            if($response->loader->type==HTMLLoader::TYPE_HTML){
                //$response->status=Response::STATUS_LOADING;    
                //$response->save();

                $loader=new HtmlLoader();

                if($loader->load($request->request_url,$content_path)){
                    $response->regEventContentLoad();
                }else{
                    //Регистрирую ошибку загрузки контента
                    $response->regError(Response::STATUS_LOADING_ERROR,'Ошибка загрузки контента');
                }
                
            }
        }

        //Парсинг загруженного контента
        $responses=Response::find()->where(['status'=>Response::STATUS_LOADING_SUCCESS])->all();
        foreach ($responses as $key => $response){

            
            $parser = BaseParser::initParser($response->request->request_url,$response->contentPath);
            
            if($parser->run() && $parser->validate()){
                
                $response->regData($parser->json);

            }else{
                $response->regError(Response::STATUS_PARSING_ERROR,json_encode($parser->errors));
            }
        }
        
    }

    
    
  
}