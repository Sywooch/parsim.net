<?php

namespace common\models\parsers\classes;

use Yii;

use GuzzleHttp\Client; // подключаем Guzzle


class HttpLoader extends ContentLoader
{

    public function loadContent($url,$path)
    {
        $httpClient = new Client();  
        //$httpClient = new Client(['base_uri' => $url]);
        //$res = $httpClient->request('GET', '/');
        $res = $httpClient->get($url);
        $html = $res->getBody();
        //$content=str_replace('script', 'tag_script', file_get_contents($contentFullPath)) ;
        $html=preg_replace('/script/', 'tag_script',$html);
        return file_put_contents($path,$html);

    }
    
}
