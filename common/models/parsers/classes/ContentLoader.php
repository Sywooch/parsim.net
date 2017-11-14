<?php

namespace common\models\parsers\classes;

use Yii;
use yii\base\Model;


class ContentLoader extends Model
{
    const TYPE_HTTP = 'httpClient';
    const TYPE_IMACROS = 'iMacros';

    public static $iMacrosHosts = [
      'yandex.ru',

    ];

    public static function getTypeByUrl($url){
      $host=parse_url($url,PHP_URL_HOST);
      return isset(self::$iMacrosHosts[$host])?self::TYPE_IMACROS:self::TYPE_HTML;
    }
}
