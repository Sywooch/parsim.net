<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_response`.
 */
class m180124_185939_create_order_response_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%order_response}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'response_id' => $this->integer()->notNull(),
            'qty' => $this->integer()->notNull()->defaultValue(1),
            'price' => $this->money()->notNull()->defaultValue(0),
            'status' => $this->integer()->notNull()->defaultValue(0),

            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),

        ], $tableOptions);

        // creates index for column `order_id`
        $this->createIndex(
            'fki-order-response-order-id',
            '{{%order_response}}',
            'order_id'
        );
        
        // add foreign key for table `order_id`
        $this->addForeignKey(
            'fk-order-response-order-id',
            '{{%order_response}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE'
        );

        // creates index for column response_id`
        $this->createIndex(
            'fki-order-response-response-id',
            '{{%order_response}}',
            'response_id'
        );
        
        // add foreign key for table `response_id`
        $this->addForeignKey(
            'fk-order-response-response-id',
            '{{%order_response}}',
            'response_id',
            '{{%parser}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            'fki-order-response-created-by',
            '{{%order_response}}',
            'created_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-order-response-created-by',
            '{{%order_response}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-order_response-updated-by',
            '{{%order_response}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-order_response-updated-by',
            '{{%order_response}}',
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
        $this->dropTable('{{%order_response}}');
    }
}
