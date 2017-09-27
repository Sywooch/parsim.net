<?php

namespace console\controllers;


use Yii;
use yii\console\Controller;
use common\models\Request;
use common\models\Response;

use common\models\HtmlLoader;

use common\models\parsers\BaseParser;


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
        $requests=Request::find()->where(['status'=>Request::STATUS_READY])->all();
        
        foreach ($requests as $key => $request) {
            $request->addResponse();
        }

        //Загрузка контента htmlClient
        $responses=Response::find()->where(['status'=>Request::STATUS_READY])->all();
        foreach ($responses as $key => $response){
            
            $request=$response->request;
            $content_path=$response->contentPath;

            if($request->loader==HtmlLoader::TYPE_HTML){
                $response->status=Response::STATUS_LOADING;    
                $response->save();

                $loader=new HtmlLoader();

                if($loader->load($request->request_url,$content_path)){
                    $response->status=Response::STATUS_LOADING_SUCCESS;
                }else{
                    $response->status=Response::STATUS_LOADING_ERROR;        
                }
                $response->save();
            }
        }

        //Парсинг загруженного контента
        $responses=Response::find()->where(['status'=>Response::STATUS_LOADING_SUCCESS])->all();
        foreach ($responses as $key => $response){

            $request=$response->request;
            $url=$request->request_url;
            
            $parser = BaseParser::initParser($url,$response->contentPath);
            //$parser->contentPath=$response->contentPath;
            
            //$json=$parser->productCard;
            //$this->stdout($status['status']. PHP_EOL);
            
            if($parser->run() && $parser->validate()){

                $response->json=$parser->json;
                $response->error=null;


                $response->status=Response::STATUS_PARSING_SUCCESS;
                $request->status=Request::STATUS_SUCCESS;
            }else{
                $response->json=null;
                $response->error=json_encode($parser->errors);

                $response->status=Response::STATUS_PARSING_ERROR;
                $request->status=Request::STATUS_ERROR;
            }
            
            if($response->save() && $request->save()){
                $response->sendData();
            }
        }
        
    }

    
    
  
}