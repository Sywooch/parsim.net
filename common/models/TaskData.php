<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_data".
 *
 * @property integer $id
 * @property integer $task_id
 * @property string $key
 * @property string $selector
 * @property string $value
 */
class TaskData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key','selector'], 'required'],
            [['task_id'], 'integer'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 64],
            [['selector'], 'string', 'max' => 128],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'task_id' => Yii::t('app', 'Task ID'),
            'key' => Yii::t('app', 'Key'),
            'selector' => Yii::t('app', 'Selector'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
