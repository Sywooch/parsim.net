<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket`.
 */
class m171122_125331_create_ticket_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%ticket}}', [
            'id' => $this->primaryKey(),
            'alias'=>$this->string(16)->notNull(),
            'category_id' => $this->integer()->notNull(),
            'subject'=>$this->string(256)->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0),

            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),

        ], $tableOptions);

        // creates index for column `category_id`
        $this->createIndex(
            'fki-ticket-category-id',
            '{{%ticket}}',
            'category_id'
        );
        
        // add foreign key for table `ticket_category`
        $this->addForeignKey(
            'fk-ticket-category-id',
            '{{%ticket}}',
            'category_id',
            '{{%ticket_category}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            'fki-ticket-created-by',
            '{{%ticket}}',
            'created_by'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-ticket-created-by',
            '{{%ticket}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-ticket-updated-by',
            '{{%ticket}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-ticket-updated-by',
            '{{%ticket}}',
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
        $this->dropTable('{{%ticket}}');
    }
}
