<?php

namespace common\models;

use Yii;


class iMacrosLoader extends ContentLoader
{

    public function load($url,$path)
    {
        $httpClient = new Client();  
        $res = $httpClient->request('GET', $url);
        $charset=trim(explode('=', $res->getHeader('content-type')[0])[1]);
        $html = $res->getBody();
        if($charset!='utf-8'){
          $html=iconv($charset,"UTF-8", $html);
        }

        return file_put_contents($path,$html);

    }
    
}
