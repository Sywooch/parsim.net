<?php

use yii\db\Migration;

/**
 * Handles the creation of table `loader`.
 */
class m170824_093800_create_loader_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%loader}}', [
            'id' => $this->primaryKey(),
            'alias'=>$this->string(16)->notNull(),

            'type' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->integer()->notNull()->defaultValue(0),

            'created_by' => $this->integer()->notNull()->defaultValue(1),
            'updated_by' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        // creates index for column `created_by`
        $this->createIndex(
            'fki-loader-created-by',
            '{{%loader}}',
            'created_by'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-loader-created-by',
            '{{%loader}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-loader-updated-by',
            '{{%loader}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-loaders-updated-by',
            '{{%loader}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->batchInsert('{{%loader}}', ['alias', 'type'], [
            //User status
            [uniqid(), 0],
            [uniqid(), 1],
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%loader}}');
    }
}
