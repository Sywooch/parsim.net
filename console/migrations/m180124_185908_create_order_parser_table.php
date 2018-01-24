<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_parser`.
 */
class m180124_185908_create_order_parser_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%order_parser}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'parser_id' => $this->integer()->notNull(),
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
            'fki-order-parser-order-id',
            '{{%order_parser}}',
            'order_id'
        );
        
        // add foreign key for table `order_id`
        $this->addForeignKey(
            'fk-order-parser-order-id',
            '{{%order_parser}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE'
        );

        // creates index for column parser_id`
        $this->createIndex(
            'fki-order-parser-parser-id',
            '{{%order_parser}}',
            'parser_id'
        );
        
        // add foreign key for table `parser_id`
        $this->addForeignKey(
            'fk-order-parser-parser-id',
            '{{%order_parser}}',
            'parser_id',
            '{{%parser}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            'fki-order-parser-created-by',
            '{{%order_parser}}',
            'created_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-order-parser-created-by',
            '{{%order_parser}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-order_parser-updated-by',
            '{{%order_parser}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-order_parser-updated-by',
            '{{%order_parser}}',
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
        $this->dropTable('{{%order_parser}}');
    }
}
