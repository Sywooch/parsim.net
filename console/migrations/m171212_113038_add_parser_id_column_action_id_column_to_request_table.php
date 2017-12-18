<?php

use yii\db\Migration;

/**
 * Handles adding parser_id_column_action_id to table `request`.
 */
class m171212_113038_add_parser_id_column_action_id_column_to_request_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('request', 'parser_id', $this->integer());
        $this->addColumn('request', 'action_id', $this->integer());

        // creates index for column `parser_id`
        $this->createIndex(
            'fki-request-paresr-id',
            '{{%request}}',
            'parser_id'
        );
        
        // add foreign key for table `parser`
        $this->addForeignKey(
            'fk-request-parser-id',
            '{{%request}}',
            'parser_id',
            '{{%parser}}',
            'id',
            'CASCADE'
        );

        // creates index for column `action_id`
        $this->createIndex(
            'fki-request-action-id',
            '{{%request}}',
            'action_id'
        );
        
        // add foreign key for table `parser`
        $this->addForeignKey(
            'fk-request-action-id',
            '{{%request}}',
            'action_id',
            '{{%parser_action}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('request', 'parser_id');
        $this->dropColumn('request', 'action_id');
    }
}
