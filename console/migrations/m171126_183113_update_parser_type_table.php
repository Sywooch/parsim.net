<?php

use yii\db\Migration;

class m171126_183113_update_parser_type_table extends Migration
{
    public function safeUp()
    {

    }

   
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->update('{{%parser_type}}', ['name'=>'Product'], ['name'=>'ProductCard']);

        $this->batchInsert('{{%parser_type}}', ['name'], [
            ['Account'],
        ]);

    }

    public function down()
    {
        $this->update('{{%parser_type}}', ['name'=>'ProductCard'], ['name'=>'Product']);

        $this->delete('{{%parser_type}}', ['name'=>'Account']);

        return false;
    }
    
}
