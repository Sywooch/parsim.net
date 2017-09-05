<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $parent_id
 * @property integer $type
 * @property string $path
 * @property string $title
 * @property string $url
 * @property string $aviso_url
 * @property integer $start
 * @property integer $finish
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Project extends Task
{
    const STATUS_NEW = 0;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','status'], 'required'],
            
        ];
    }
    

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    //Backend URLs 
    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['project/update','alias'=>$this->alias]);
    }
    public function getViewUrl(){
        return Yii::$app->urlManager->createUrl(['project/view','alias'=>$this->alias]);
    }
    public function getCreateTaskUrl(){
        return Yii::$app->urlManager->createUrl(['/task/create','project'=>$this->alias]);
    }


    
}
