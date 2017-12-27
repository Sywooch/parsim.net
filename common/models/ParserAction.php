<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parser_action".
 *
 * @property integer $id
 * @property integer $parser_id
 * @property string $name
 * @property integer $status
 * @property string $selector
 * @property string $example_url
 * @property string $code
 *
 * @property Parser $parser
 */
class ParserAction extends \yii\db\ActiveRecord
{
    
    const STATUS_READY = 0;
    const STATUS_HAS_ERROR = 1;
    const STATUS_FIXING = 2;
    
    public static function tableName()
    {
        return 'parser_action';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'selector', 'example_url'], 'required'],
            [['parser_id', 'status','seq'], 'integer'],
            [['code'], 'string'],
            [['name', 'selector', 'example_url'], 'string', 'max' => 512],
            [['parser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parser::className(), 'targetAttribute' => ['parser_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parser_id' => 'Parser ID',
            'name' => 'Name',
            'status' => 'Status',
            'selector' => 'Selector',
            'example_url' => 'Example Url',
            'code' => 'Code',
        ];
    }

    //=========================================================
    //
    // Блок relations
    //
    //=========================================================

    public function getParser()
    {
        return $this->hasOne(Parser::className(), ['id' => 'parser_id']);
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


    //=========================================================
    //
    // Блок вспомагательных методов
    //
    //=========================================================
    public function run($url=null){
        if(isset($url)){
            $url=$this->example_url;
        }

        return json_encode([$this->name=>'111']);
    }

    
}
