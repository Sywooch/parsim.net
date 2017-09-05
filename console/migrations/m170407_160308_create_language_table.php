<?php

use yii\db\Migration;

/**
 * Handles the creation of table `langs`.
 */
class m170407_160308_create_language_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%language}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(255)->notNull(),
            'local' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'default' => $this->smallInteger()->notNull()->defaultValue(0),
            
            'created_by' => $this->integer()->notNull()->defaultValue(1),
            'updated_by' => $this->integer()->notNull()->defaultValue(1),
            
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ]);
        // creates index for column `created_by`
        $this->createIndex(
            'fki-language-created-by',
            '{{%language}}',
            'created_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-language-created-by',
            '{{%language}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-language-updated-by',
            '{{%language}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-language-updated-by',
            '{{%language}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->batchInsert('language', ['url', 'local', 'name', 'default'], [
            ['en', 'en-EN', 'English', 0],
            ['de', 'de-DE', 'Deutsch', 0],
            ['ru', 'ru-RU', 'Русский', 1],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%language}}');
    }
}
