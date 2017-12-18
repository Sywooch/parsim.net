<?php

namespace common\models\parsers\classes;

use Yii;

use GuzzleHttp\Client; // подключаем Guzzle


class HttpLoader extends ContentLoader
{

    public function loadContent($url,$path,$charset='utf-8')
    {
        $httpClient = new Client();  
        //$httpClient = new Client(['base_uri' => $url]);
        //$res = $httpClient->request('GET', '/');
        $res = $httpClient->get($url);
        $html = $res->getBody();
        
        if($charset!='utf-8'){
            //$html = iconv($charset,'utf-8',$html);    
        }

        $html=preg_replace('/script/', 'tag_script',$html);

        return file_put_contents($path,$html);

    }
    
}
