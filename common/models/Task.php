<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;

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
class Task extends \yii\db\ActiveRecord
{
    const TYPE_PROJECT = 0;
    const TYPE_TASK = 1;
    
    const STATUS_NEW = 0;
    const STATUS_READY_TO_LOAD = 1;
    const STATUS_LOADING = 2;
    const STATUS_READY_TO_PARSE = 3;
    const STATUS_PARSING = 4;



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'AutoAlias'=>[
                'class' => 'common\behaviors\AliasGenerator',
                'dst'=>'alias',
            ],
            'TreeBehavior'=>[
                'class' => 'common\behaviors\TreeBehavior',
            ],
        ];
    }

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================
    public function getParent(){
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    public function getChildren(){
        return $this->hasMany(Task::className(), ['parent_id' => 'id']);
    }

    public function getDataItems(){
        return $this->hasMany(TaskData::className(), ['task_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['parent_id', 'type', 'start', 'finish', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['alias'], 'string', 'max' => 16],
            [['path'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 64],
            [['url', 'aviso_url'], 'string', 'max' => 512],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'type' => Yii::t('app', 'Type'),
            'path' => Yii::t('app', 'Path'),
            'title' => Yii::t('app', 'Title'),
            'url' => Yii::t('app', 'Url'),
            'aviso_url' => Yii::t('app', 'Aviso Url'),
            'start' => Yii::t('app', 'Start'),
            'finish' => Yii::t('app', 'Finish'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    public function getStatusName(){
        return Lookup::item('TASK_STATUS',$this->status);
    }
    public function getChangeAge(){
        return (time()-$this->updated_at)/60;
    }

    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    //Backend URLs 
    public function getUpdateUrl(){
        return Yii::$app->urlManager->createUrl(['/task/update','alias'=>$this->alias]);
    }

    public function afterSave ( $insert, $changedAttributes ){
        parent::afterSave($insert, $changedAttributes);
        
        //Нужно вынестив контроллер, так не работают консольные команды
        /*
        if(isset(Yii::$app->request->post()['TaskData'])){
            $dataItems=Yii::$app->request->post()['TaskData'];


            TaskData::deleteAll(['task_id'=>$this->id]);
            foreach ($dataItems as $key => $data) {
                $taskData= new TaskData();
                $taskData->task_id=$this->id;
                $taskData->key=$data['key'];
                $taskData->selector=$data['selector'];
                $taskData->save();
            }
        
            
        }
        */
    }
    


}
