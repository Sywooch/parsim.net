<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 */
class m170605_131120_create_transaction_table extends Migration
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

            'order_id' => $this->integer()->notNull(),
            
            'response_id' => $this->integer(),

            'status' => $this->integer()->notNull()->defaultValue(0),

            'amount'=>$this->float(),

            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
            
        ], $tableOptions);

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
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%transaction}}');
    }
}
