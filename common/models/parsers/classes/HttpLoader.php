<?php

namespace common\models\parsers\classes;

use Yii;

use GuzzleHttp\Client; // подключаем Guzzle


class HttpLoader extends ContentLoader
{

    public function loadContent($url,$path)
    {
        $httpClient = new Client();  
        $res = $httpClient->request('GET', $url);
        $html = $res->getBody();

        return file_put_contents($path,$html);

    }
    
}
