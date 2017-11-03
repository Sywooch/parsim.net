<?php

use yii\db\Migration;

/**
 * Handles the creation of table `error`.
 */
class m170926_140642_create_error_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%error}}', [
            'id' => $this->primaryKey(),
            'alias'=>$this->string(16)->notNull(),
            
            'parser_id' => $this->integer(), 
            'request_id' => $this->integer(),
            'response_id' => $this->integer(),
            'loader_id' => $this->integer(), 
            

            'status' => $this->integer()->notNull()->defaultValue(0),

            'code' => $this->integer()->notNull()->defaultValue(100),
            'msg' => $this->text(),
            'description' => $this->text(),

            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),

        ], $tableOptions);

        // creates index for column `request_id`
        $this->createIndex(
            'fki-error-request-id',
            '{{%error}}',
            'request_id'
        );
        
        // add foreign key for table `request`
        $this->addForeignKey(
            'fk-error-request-id',
            '{{%error}}',
            'request_id',
            '{{%request}}',
            'id',
            'CASCADE'
        );


        // creates index for column `response_id`
        $this->createIndex(
            'fki-error-response-id',
            '{{%error}}',
            'response_id'
        );
        
        // add foreign key for table `response`
        $this->addForeignKey(
            'fk-error-response-id',
            '{{%error}}',
            'response_id',
            '{{%response}}',
            'id',
            'CASCADE'
        );

        // creates index for column `loader_id`
        $this->createIndex(
            'fki-error-loader-id',
            '{{%error}}',
            'loader_id'
        );
        
        // add foreign key for table `loader`
        $this->addForeignKey(
            'fk-error-loader-id',
            '{{%error}}',
            'loader_id',
            '{{%loader}}',
            'id',
            'CASCADE'
        );

        // creates index for column `parser_id`
        $this->createIndex(
            'fki-error-parser-id',
            '{{%error}}',
            'parser_id'
        );
        
        // add foreign key for table `parser`
        $this->addForeignKey(
            'fk-error-parser-id',
            '{{%error}}',
            'parser_id',
            '{{%parser}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%error}}');
    }
}
