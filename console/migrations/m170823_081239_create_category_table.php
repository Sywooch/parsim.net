<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m170823_081239_create_category_table extends Migration
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
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            
            'type' => $this->integer()->notNull()->defaultValue(0),
            'path'=>$this->string(255)->notNull()->defaultValue('/'),

            'alias' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->string(255),

            'status' => $this->integer()->notNull()->defaultValue(1),
            
        ], $tableOptions);

        // creates index for column `parent_id`
        $this->createIndex(
            'fki-category-parent-id',
            '{{%category}}',
            'parent_id'
        );
        
        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-categorys-parent-id',
            '{{%category}}',
            'parent_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );
        
        $this->batchInsert('{{%category}}', ['id','parent_id', 'type', 'alias','name','path'], [
            //Parser category
            [1,null,0,'parser-category','Parser category','/parser-category'],
            [2,1,0,'product-list','ProductList','/parser-category/product-list'],
            [3,1,0,'product-card','ProductCard','/parser-category/product-card'],
        ]);
    
        $this->execute('ALTER SEQUENCE category_id_seq RESTART WITH 4');
        
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}