<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "parser_action".
 *
 * @property integer $id
 * @property integer $parser_id
 * @property integer $category_id
 * @property integer $order_num
 * @property string $name
 * @property string $reg_exp
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class ParserAction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['parser_id', 'category_id','reg_exp'], 'required'],
            [['parser_id', 'category_id', 'order_num', 'status'], 'integer'],
            [['reg_exp'], 'string', 'max' => 512],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['parser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parser::className(), 'targetAttribute' => ['parser_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parser_id' => Yii::t('app', 'Parser ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'order_num' => Yii::t('app', 'Order Num'),
            'reg_exp' => Yii::t('app', 'Reg Exp'),
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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


    public function getCategoryList(){
        return ArrayHelper::map(Category::find()->where(['parent_id'=>1])->all(),'id','name');
    }

    
}
