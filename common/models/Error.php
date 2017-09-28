<?php

namespace common\models;


use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "error".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $request_id
 * @property integer $response_id
 * @property integer $loader_id
 * @property integer $parser_id
 * @property integer $action_id
 * @property integer $status
 * @property string $msg
 */
class Error extends \yii\db\ActiveRecord
{
    const CODE_UNKNOW_ERROR = 100;
    const CODE_PARSER_NOT_FOUND = 200;
    const CODE_PARSER_ACTION_NOT_FOUND = 201;
    const CODE_PARSING_ERROR = 202;
    const CODE_LOADER_NOT_FOUND = 300;
    const CODE_LOADING_ERROR = 301;
    
    const STATUS_NEW = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_TESTING = 2;
    const STATUS_FIXED = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'error';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'AutoAlias'=>[
                'class' => 'common\behaviors\AliasGenerator',
                'dst'=>'alias',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_id', 'response_id', 'loader_id', 'parser_id', 'action_id', 'status'], 'integer'],
            [['msg'], 'string'],
            [['alias'], 'string', 'max' => 16],
            [['loader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Loader::className(), 'targetAttribute' => ['loader_id' => 'id']],
            [['parser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parser::className(), 'targetAttribute' => ['parser_id' => 'id']],
            [['action_id'], 'exist', 'skipOnError' => true, 'targetClass' => ParserAction::className(), 'targetAttribute' => ['action_id' => 'id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
            [['response_id'], 'exist', 'skipOnError' => true, 'targetClass' => Response::className(), 'targetAttribute' => ['response_id' => 'id']],
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
            'request_id' => Yii::t('app', 'Request ID'),
            'response_id' => Yii::t('app', 'Response ID'),
            'loader_id' => Yii::t('app', 'Loader ID'),
            'parser_id' => Yii::t('app', 'Parser ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'status' => Yii::t('app', 'Status'),
            'msg' => Yii::t('app', 'Msg'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if(isset(Yii::$app->params['errorEmail'])){
           Yii::$app->mailqueue->compose(['html' => 'error/view'], ['model' => $this])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo(Yii::$app->params['errorEmail'])
                ->setSubject('Parsing error registred')
                ->queue();
        }
        
    }
}
