<?php

namespace frontend\modules\api\models;

use Yii;
use common\models\Response;


class RestResponse extends Response
{
  public function fields()
  {
      return [
          'json',
      ];
  }
}
