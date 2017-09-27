<?php

use yii\db\Migration;

/**
 * Handles the creation of table `request`.
 */
class m170825_093808_create_request_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'alias'=>$this->string(16)->notNull(),
            'response_id' => $this->integer(), 

            'request_url' => $this->string(512)->notNull(), //url, который нужно парсить
            'response_url' => $this->string(512),           //url, на который нужно отправить ответ
            'response_email' => $this->string(512),         //e-mail, на который нужно отправить ответ

            'ip' => $this->string(15),  

            'tarif_id' => $this->integer(),                 //прайс, по которому оплачивется услуга парсинга

            'sleep_time' => $this->integer(), 

            'status' => $this->integer()->notNull()->defaultValue(0),

            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        

        // creates index for column `created_by`
        $this->createIndex(
            'fki-request-created-by',
            '{{%request}}',
            'created_by'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-request-created-by',
            '{{%request}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-request-updated-by',
            '{{%request}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-requests-updated-by',
            '{{%request}}',
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
        $this->dropTable('{{%request}}');
    }
}
