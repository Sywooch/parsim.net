<?php

namespace common\models;

use Yii;

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
            [['parser_id', 'category_id', 'name', 'reg_exp'], 'required'],
            [['parser_id', 'category_id', 'order_num', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'reg_exp'], 'string', 'max' => 512],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['parser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parser::className(), 'targetAttribute' => ['parser_id' => 'id']],
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
            'parser_id' => Yii::t('app', 'Parser ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'order_num' => Yii::t('app', 'Order Num'),
            'name' => Yii::t('app', 'Name'),
            'reg_exp' => Yii::t('app', 'Reg Exp'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
