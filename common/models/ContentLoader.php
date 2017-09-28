<?php

namespace common\models;

use Yii;
use yii\base\Model;


class ContentLoader extends Model
{
    const TYPE_HTML = 'htmlClient';
    const TYPE_IMACROS = 'iMacros';

    public static $iMacrosHosts = [
      'yandex.ru',

    ];

    public static function getTypeByUrl($url){
      $host=parse_url($url,PHP_URL_HOST);
      return isset(self::$iMacrosHosts[$host])?self::TYPE_IMACROS:self::TYPE_HTML;
    }
}