<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parser_type`.
 */
class m170824_093807_create_parser_type_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%parser_type}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(128)->notNull(),
        ], $tableOptions);
        

        $this->batchInsert('{{%parser_type}}', ['name'], [
            ['ProductCard'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%parser_type}}');
    }
}
