<?php

use yii\db\Migration;

/**
 * Handles adding user_id_column_action_id_column_transaction_id to table `error`.
 */
class m171212_132127_add_user_id_column_action_id_column_transaction_id_column_to_error_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('error', 'user_id', $this->integer());
        $this->addColumn('error', 'action_id', $this->integer());
        $this->addColumn('error', 'transaction_id', $this->integer());

        // creates index for column `user_id`
        $this->createIndex(
            'fki-error-user-id',
            '{{%error}}',
            'user_id'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-error-user-id',
            '{{%error}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `action_id`
        $this->createIndex(
            'fki-error-action-id',
            '{{%error}}',
            'action_id'
        );
        
        // add foreign key for table `parser`
        $this->addForeignKey(
            'fk-request-action-id',
            '{{%error}}',
            'action_id',
            '{{%parser_action}}',
            'id',
            'CASCADE'
        );

        // creates index for column `transaction_id`
        $this->createIndex(
            'fki-error-transaction-id',
            '{{%error}}',
            'transaction_id'
        );
        
        // add foreign key for table `parser`
        $this->addForeignKey(
            'fk-request-transaction-id',
            '{{%error}}',
            'transaction_id',
            '{{%transaction}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('error', 'user_id');
        $this->dropColumn('error', 'action_id');
        $this->dropColumn('error', 'transaction_id');
    }
}
