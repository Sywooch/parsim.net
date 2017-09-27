<?php

namespace frontend\modules\api\models;

use Yii;
use common\models\Request;


class RestRequest extends Request
{
    public function fields()
    {
        return [
            'alias',
            'status',
        ];
    }
}
