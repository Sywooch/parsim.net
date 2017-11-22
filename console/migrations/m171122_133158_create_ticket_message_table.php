<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket_message_message`.
 */
class m171122_133158_create_ticket_message_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%ticket_message}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'ticket_id' => $this->integer()->notNull(),
            'message'=>$this->text()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0),

            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),

        ], $tableOptions);

        // creates index for column `ticket_id`
        $this->createIndex(
            'fki-ticket-message-ticket-id',
            '{{%ticket_message}}',
            'ticket_id'
        );
        
        // add foreign key for table `ticket`
        $this->addForeignKey(
            'fk-ticket-message-ticket-id',
            '{{%ticket_message}}',
            'ticket_id',
            '{{%ticket}}',
            'id',
            'CASCADE'
        );

        // creates index for column `parent_id`
        $this->createIndex(
            'fki-ticket-message-parent-id',
            '{{%ticket_message}}',
            'parent_id'
        );
        
        // add foreign key for table `ticket_message`
        $this->addForeignKey(
            'fk-ticket-message-parent-id',
            '{{%ticket_message}}',
            'parent_id',
            '{{%ticket_message}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            'fki-ticket-message-created-by',
            '{{%ticket_message}}',
            'created_by'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-ticket-message-created-by',
            '{{%ticket_message}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-ticket-message-updated-by',
            '{{%ticket_message}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-ticket-message-updated-by',
            '{{%ticket_message}}',
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
        $this->dropTable('{{%ticket_message}}');
    }
}
