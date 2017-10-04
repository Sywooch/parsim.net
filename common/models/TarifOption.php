<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tarif_option".
 *
 * @property integer $id
 * @property integer $tarif_id
 * @property string $title
 * @property string $description
 */
class TarifOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tarif_option';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarif_id', 'title'], 'required'],
            [['tarif_id'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['tarif_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tarif::className(), 'targetAttribute' => ['tarif_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tarif_id' => Yii::t('app', 'Tarif ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
        ];
    }
}
