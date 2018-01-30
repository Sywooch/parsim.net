<?php

namespace console\controllers;


use Yii;
use yii\console\Controller;
use common\models\Request;
use common\models\Response;

use common\models\parsers\classes\HttpLoader;
use common\models\parsers\classes\BaseParser;


class ResponseController extends Controller
{

    public function actionUpdate(){

        $requests=Request::getReadyToProcess();
        
        foreach ($requests as $key => $request) {
            //Создаю новый ответ
            $this->stdout('URL: '.$request->request_url.PHP_EOL);
            //$request->addResponse();
            $response=new Response;
            $response->scenario=Response::SCENARIO_INSERT;

            $response->request_id=$requests->id;
            $response->status=Response::STATUS_READY;
            if($response->save()){
                $this->stdout('Создан запрос: '.$response->alias.PHP_EOL);
            }else{
                $this->stdout('Создан запрос: '.json_encode($response->errors,JSON_UNESCAPED_UNICODE).PHP_EOL);
            }
        }

        /*

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

            //$this->stdout('Path: '.$content_path.PHP_EOL);

            if($response->loader->type==HttpLoader::TYPE_HTTP){
                //$response->status=Response::STATUS_LOADING;    
                //$response->save();

                $loader=new HttpLoader();

                if($loader->loadContent($request->request_url,$content_path)){
                    $response->regEventContentLoad();
                }else{
                    //Регистрирую ошибку загрузки контента
                    //$response->regError(Response::STATUS_LOADING_ERROR,'Ошибка загрузки контента');
                }
                
            }
        }


        //Парсинг загруженного контента
        $responses=Response::find()->where(['status'=>Response::STATUS_LOADING_SUCCESS])->all();
        foreach ($responses as $key => $response){

            
            $parser = BaseParser::initParser($response);

            if($data=$parser->run()){
                
                $response->regData($data);

            }else{
                $this->stdout('Ошибка: '.PHP_EOL);

                //Блокирую последующую обработку ответа
                //и сторнирую оплату (если была)
                $response->rollBack(Response::STATUS_PARSING_ERROR);
                
                $response->regError(Response::STATUS_PARSING_ERROR,json_encode($info));

            }
        }
        */
        
    }

    
    
  
}