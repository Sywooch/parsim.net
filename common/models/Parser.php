<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "parser".
 *
 * @property integer $id
 * @property string $alias
 * @property string $name
 * @property string $host
 * @property string $loader
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Parser extends \yii\db\ActiveRecord
{
    const STATUS_READY = 0;
    const STATUS_HAS_ERROR = 1;
    const STATUS_FIXING = 2;

    public $parserActionsArray=[];

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'AutoAlias'=>[
                'class' => 'common\behaviors\AliasGenerator',
                //'src'=>'title',
                'dst'=>'alias',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parser';
    }

    //=========================================================
    //
    // Validate rules
    //
    //=========================================================
    public function rules()
    {
        return [
            [['class_name', 'host','status','loader_type'], 'required'],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['alias'], 'string', 'max' => 16],
            [['host'], 'string', 'max' => 512],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['parserActionsArray'],'safe'],
        ];
    }

    //=========================================================
    //
    // Labels
    //
    //=========================================================
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'name' => Yii::t('app', 'Name'),
            'host' => Yii::t('app', 'Host'),
            'loader' => Yii::t('app', 'Loader'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================
    private $_actions;
    public function getActions(){
        if(!isset($this->_actions)){
            $this->_actions = $this->hasMany(ParserAction::className(), ['parser_id' => 'id'])->orderBy(['order_num'=>SORT_ASC]);
        }
        return $this->_actions;
    }
    public function setActions($value){
        $this->_actions=$value;
    }

    //=========================================================
    //
    // Блок событий ActiveRecord
    //
    //=========================================================
    public function beforeValidate()
    {
        if(!parent::beforeValidate())
            return false;

        $actions=[];
        if(is_array($this->parserActionsArray)){

            foreach ($this->parserActionsArray as $key => $value){
                $action=new ParserAction();
                $action->parser_id=$this->id;
                $action->order_num=$key;
                $action->category_id=$value['category_id'];
                $action->reg_exp=$value['reg_exp'];
                $action->status=$value['status'];

                if(!$action->validate()){
                    $this->addErrors($action->errors);
                }
                $actions[]=$action;
            }
        }
        $this->actions=$actions;


        return count($this->errors)>0?false:true;

    }
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        ParserAction::deleteAll(['parser_id'=>$this->id]);
        foreach ($this->actions as $key => $action){
            $action->save();
        }
        
        
    }

    
    //=========================================================
    //
    // Блок поисковых выдач
    //
    //=========================================================
    public static function findByClassName($className)
    {
        return Parser::find()->where(['class_name'=>$className])->one();
    }

    //=========================================================
    //
    // Блок атрибутов
    //
    //=========================================================
    public function getStatusName(){
        return Lookup::item('PARSER_STATUS',$this->status);
    }
    public function getStatusList(){
        return Lookup::items('PARSER_STATUS');
    }

    public function getLoaderName(){
        return Lookup::item('LOADER_TYPE',$this->loader_type);
    }
    public function getLoaderList(){
        return Lookup::items('LOADER_TYPE');
    }


    //=========================================================
    //
    // Блок генерации Url
    //
    //=========================================================
    public static function getIndexUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser/index']);
    }
    public static function getCreateUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser/create']);
    }
    public function getUpdateUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser/update','id'=>$this->id]);
    }
    public function getDeleteUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser/delete','id'=>$this->id]);
    }
    public function getViewUrl()
    {
        return Yii::$app->urlManager->createUrl(['parser/view','id'=>$this->id]);
    }
}
