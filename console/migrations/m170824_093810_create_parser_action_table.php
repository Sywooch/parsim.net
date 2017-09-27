<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parser_action_action`.
 */
class m170824_093810_create_parser_action_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%parser_action}}', [
            'id' => $this->primaryKey(),
            'parser_id'=>$this->integer()->notNull(),
            'category_id'=>$this->integer()->notNull(),

            'order_num'=>$this->integer()->notNull()->defaultValue(0),
            
            'name' => $this->string(512)->notNull(),
            'reg_exp' => $this->string(512)->notNull(),

            'status' => $this->integer()->notNull()->defaultValue(0),

            'created_by' => $this->integer()->notNull()->defaultValue(1),
            'updated_by' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        // creates index for column `parser_id`
        $this->createIndex(
            'fki-parser-action-parser-id',
            '{{%parser_action}}',
            'parser_id'
        );
        
        // add foreign key for table `parser`
        $this->addForeignKey(
            'fk-parser-action-parser-id',
            '{{%parser_action}}',
            'parser_id',
            '{{%parser}}',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'fki-parser-action-category-id',
            '{{%parser_action}}',
            'category_id'
        );
        
        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-parser-action-category-id',
            '{{%parser_action}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );   

        // creates index for column `created_by`
        $this->createIndex(
            'fki-parser-action-created-by',
            '{{%parser_action}}',
            'created_by'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-parser-action-created-by',
            '{{%parser_action}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-parser-action-updated-by',
            '{{%parser_action}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-parser-actions-updated-by',
            '{{%parser_action}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->batchInsert('{{%parser_action}}', ['parser_id', 'category_id', 'name', 'reg_exp','order_num'], [
            //DushevoiRu status
            [1,2,'productList', '/\bproducts\b/i',0],
            [1,3,'productCard', '/(\bproducts\b)?(\b-ware\b)/i',1],
            //CenterSantehnikiRu
            [2,2,'productList', '111',0],
            [2,3,'productCard', '222',1],
            //SantehnikaOnlineRu
            [3,2,'productList', '111',0],
            [3,3,'productCard', '222',1],
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%parser_action}}');
    }
}
