<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parser`.
 */
class m170824_093808_create_parser_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%parser}}', [
            'id' => $this->primaryKey(),
            'alias'=>$this->string(16)->notNull(),

            'host' => $this->string(512)->notNull(),

            'class_name' => $this->string(512)->notNull(),
            'loader_type' =>$this->integer()->notNull()->defaultValue(0),

            'status' => $this->integer()->notNull()->defaultValue(0),

            'created_by' => $this->integer()->notNull()->defaultValue(1),
            'updated_by' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        // creates index for column `created_by`
        $this->createIndex(
            'fki-parser-created-by',
            '{{%parser}}',
            'created_by'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-parser-created-by',
            '{{%parser}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-parser-updated-by',
            '{{%parser}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-parsers-updated-by',
            '{{%parser}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->batchInsert('{{%parser}}', ['id', 'alias', 'class_name', 'host','status'], [
            //User status
            [1, uniqid(), 'DushevoiRu','dushevoi.ru',0],
            [2, uniqid(), 'CenterSantehnikiRu','center-santehniki.ru',0],
            [3, uniqid(), 'SantehnikaOnlineRu','santehnika-online.ru',0],
        ]);

        $this->execute('ALTER SEQUENCE parser_id_seq RESTART WITH 4');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%parser}}');
    }
}
