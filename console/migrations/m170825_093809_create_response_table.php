<?php

use yii\db\Migration;

/**
 * Handles the creation of table `response`.
 */
class m170825_093809_create_response_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%response}}', [
            'id' => $this->primaryKey(),
            'alias'=>$this->string(16)->notNull(),
            'request_id' => $this->integer(), 

            'loader_id' => $this->integer(), 
            'parser_id' => $this->integer(), 
            'action_id' => $this->integer(), 
            
            'status' => $this->integer()->notNull()->defaultValue(0),

            'json' => $this->text(),
            'error' => $this->text(),

            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        // creates index for column `request_id`
        $this->createIndex(
            'fki-response-request-id',
            '{{%response}}',
            'request_id'
        );
        
        // add foreign key for table `request`
        $this->addForeignKey(
            'fk-response-request-id',
            '{{%response}}',
            'request_id',
            '{{%request}}',
            'id',
            'CASCADE'
        );


        // creates index for column `created_by`
        $this->createIndex(
            'fki-response-created-by',
            '{{%response}}',
            'created_by'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-response-created-by',
            '{{%response}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-response-updated-by',
            '{{%response}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-responses-updated-by',
            '{{%response}}',
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
        $this->dropTable('{{%response}}');
    }
}
