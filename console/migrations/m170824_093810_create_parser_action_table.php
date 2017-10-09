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
            
            'reg_exp' => $this->string(512)->notNull(),

            'status' => $this->integer()->notNull()->defaultValue(0),
            
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
        
        $this->batchInsert('{{%parser_action}}', ['parser_id', 'category_id','reg_exp','order_num'], [
            //DushevoiRu status
            [1,2, '/^(?>(?!ware).)*$/',0],
            [1,3, '/-ware[\/]{0,}$/i',1],
            //CenterSantehnikiRu
            [2,2, '/^\/catalog(\/[\w-]+){1,2}[\/]?$/i',0],
            [2,3, '/^\/catalog(\/[\w-]+){3}[\/]?$/i',1],
            //SantehnikaOnlineRu
            [3,2, '/^(?>(?!product).)*$/',0],
            [3,3, '/^\/product/',1],
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
