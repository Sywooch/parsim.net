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
            'type_id'=>$this->integer()->notNull()->defaultValue(1),
            'name'=>$this->string(128)->notNull(),

            //'class_name' => $this->string(512)->notNull(),
            'loader_type' =>$this->integer()->notNull()->defaultValue(0),
            'reg_exp' => $this->string(512)->notNull(),
            'example_url'=>$this->string(512)->notNull(),

            'status' => $this->integer()->notNull()->defaultValue(0),
            'description' => $this->text(),
            'err_description' => $this->text(),

            'created_by' => $this->integer()->notNull()->defaultValue(1),
            'updated_by' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        // creates index for column `type_id`
        $this->createIndex(
            'fki-parser-type-id',
            '{{%parser}}',
            'type_id'
        );
        
        // add foreign key for table `parser_type`
        $this->addForeignKey(
            'fk-parser-type-id',
            '{{%parser}}',
            'type_id',
            '{{%parser_type}}',
            'id',
            'CASCADE'
        );

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

        $this->batchInsert('{{%parser}}', ['alias','name','reg_exp','example_url'], [
            //User status
            [uniqid(), 'Список товаров на dushevoi.ru','(?!^.*-ware)(^https?://.*dushevoi.ru/products/)','https://www.dushevoi.ru/products/dushevye-kabiny/'],
            [uniqid(), 'Карточка товара на dushevoi.ru','^https?://.*dushevoi.ru/products/.*-ware/?$','https://www.dushevoi.ru/products/dushevaya-kabina-bolu-bl-11290m-pentas-110825-ware/'],
            [uniqid(), 'Карточка товара на santehnika-online.ru','^(http[s]?://[\w.]*santehnika-online.ru[\w./-]*)$','https://santehnika-online.ru/product/dushevoy_boks_aqualux_aq_4075gfh/'],
            [uniqid(), 'Карточка товара на center-santehniki.ru','^(http[s]?://[\w.]*center-santehniki.ru[\w./-]*)$','http://center-santehniki.ru/catalog/dushevye_kabiny_i_shtorki/dushevye_kabiny/dushevaya-kabina-am-pm-like-w80c-016-090mta/'],
        ]);

        //$this->execute('ALTER SEQUENCE parser_id_seq RESTART WITH 4');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%parser}}');
    }
}
