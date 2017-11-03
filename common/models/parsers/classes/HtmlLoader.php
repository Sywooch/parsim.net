<?php

namespace common\models\parsers\classes;

use Yii;

use GuzzleHttp\Client; // подключаем Guzzle


class HtmlLoader extends ContentLoader
{

    public function load($url,$path)
    {
        $httpClient = new Client();  
        $res = $httpClient->request('GET', $url);
        $html = $res->getBody();

        return file_put_contents($path,$html);

    }
    
}
