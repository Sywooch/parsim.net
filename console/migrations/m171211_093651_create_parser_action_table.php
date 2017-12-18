<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parser_action`.
 */
class m171211_093651_create_parser_action_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%parser_action}}', [
            'id' => $this->primaryKey(), 
            'parser_id' => $this->integer()->notNull(),
            'seq' => $this->integer()->notNull()->defaultValue(0),

            'name' => $this->string(128)->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0),

            'selector' => $this->string(128)->notNull(),
            'example_url' => $this->string(128)->notNull(),
            'code' => $this->text(),
            'description' => $this->text(),
            
        ], $tableOptions);

        // creates index for column `parser_id`
        $this->createIndex(
            'fki-parser-action-paresr-id',
            '{{%parser_action}}',
            'parser_id'
        );
        
        // add foreign key for table `parser_id`
        $this->addForeignKey(
            'fk-parser-action-parser-id',
            '{{%parser_action}}',
            'parser_id',
            '{{%parser}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%parser_action}}');
    }
}
