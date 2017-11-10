<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 */
class m170825_093810_create_transaction_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(), 
            'type' => $this->integer()->notNull()->defaultValue(0),

            'user_id' => $this->integer()->notNull(),
            'order_id' => $this->integer(),
            'response_id' => $this->integer(),
            'request_id' => $this->integer(),

            'status' => $this->integer()->notNull()->defaultValue(0),

            'amount'=>$this->money()->notNull(),
            'description'=>$this->text(),

            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
            
        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            'fki-transaction-user-id',
            '{{%transaction}}',
            'user_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-transaction-user-id',
            '{{%transaction}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
            
        );

        // creates index for column `order_id`
        $this->createIndex(
            'fki-transaction-order-id',
            '{{%transaction}}',
            'order_id'
        );
        // add foreign key for table `order`
        $this->addForeignKey(
            'fk-transaction-order-id',
            '{{%transaction}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE'
            
        );

        // creates index for column `response_id`
        $this->createIndex(
            'fki-transaction-response-id',
            '{{%transaction}}',
            'response_id'
        );
        // add foreign key for table `response`
        $this->addForeignKey(
            'fk-transaction-response-id',
            '{{%transaction}}',
            'response_id',
            '{{%response}}',
            'id',
            'CASCADE'
        );

        // creates index for column `request_id`
        $this->createIndex(
            'fki-transaction-request-id',
            '{{%transaction}}',
            'request_id'
        );
        // add foreign key for table `request`
        $this->addForeignKey(
            'fk-transaction-request-id',
            '{{%transaction}}',
            'request_id',
            '{{%request}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%transaction}}');
    }
}
