<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task_data_data`.
 */
class m170903_145405_create_task_data_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%task_data}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),

            'key' => $this->string(64),
            'selector' => $this->string(128),
            'value' => $this->text(),
        ]);

        // creates index for column `task_id`
        $this->createIndex(
            'fki-task-data-task-id',
            '{{%task_data}}',
            'task_id'
        );
        
        // add foreign key for table `task`
        $this->addForeignKey(
            'fk-task-data-task-id',
            '{{%task_data}}',
            'task_id',
            '{{%task}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%task_data}}');
    }
}
