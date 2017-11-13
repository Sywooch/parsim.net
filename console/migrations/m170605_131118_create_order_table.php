<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_order`.
 */
class m170605_131118_create_order_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(), 
            'alias'=>$this->string(16)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'tarif_id' => $this->integer()->notNull(),

            'status' => $this->integer()->notNull()->defaultValue(0),

            'created_by' => $this->integer()->notNull()->defaultValue(1),
            'updated_by' => $this->integer()->notNull()->defaultValue(1),
            
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),

            'qty' => $this->integer()->notNull()->defaultValue(1),
            'price' => $this->money()->notNull(),
            'amount' => $this->money()->notNull(),
            
        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            'fki-order-user-id',
            '{{%order}}',
            'user_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-order-user-id',
            '{{%order}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `tarif_id`
        $this->createIndex(
            'fki-order-tarif-id',
            '{{%order}}',
            'tarif_id'
        );
        // add foreign key for table `tarif`
        $this->addForeignKey(
            'fk-order-tarif-id',
            '{{%order}}',
            'tarif_id',
            '{{%tarif}}',
            'id',
            'CASCADE'
        );


        // creates index for column `created_by`
        $this->createIndex(
            'fki-order-created-by',
            '{{%order}}',
            'created_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-order-created-by',
            '{{%order}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-order-updated-by',
            '{{%order}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-order-updated-by',
            '{{%order}}',
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
        $this->dropTable('{{%order}}');
    }
}
