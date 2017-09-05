<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m170825_093808_create_task_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'alias'=>$this->string(16)->notNull(),
            'parent_id' => $this->integer(),
            'type' => $this->integer()->notNull()->defaultValue(0),
            'path'=>$this->string(255)->notNull()->defaultValue('/'),

            'title' => $this->string(64),
            'url' => $this->string(512),
            'aviso_url' => $this->string(512),
            
            'start' => $this->integer()->notNull()->defaultValue(0),
            'finish' => $this->integer()->notNull()->defaultValue(0),

            'status' => $this->integer()->notNull()->defaultValue(0),

            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            'fki-task-parent-id',
            '{{%task}}',
            'parent_id'
        );
        
        // add foreign key for table `task`
        $this->addForeignKey(
            'fk-task-parent-id',
            '{{%task}}',
            'parent_id',
            '{{%task}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            'fki-task-created-by',
            '{{%task}}',
            'created_by'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-task-created-by',
            '{{%task}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-task-updated-by',
            '{{%task}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-tasks-updated-by',
            '{{%task}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%task}}');
    }
}
