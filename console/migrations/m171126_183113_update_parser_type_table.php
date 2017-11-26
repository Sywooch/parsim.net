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
        $this->update('{{%parser_type}}', ['name'=>'Account'], ['name'=>'ProductList']);
        

    }

    public function down()
    {
        $this->update('{{%parser_type}}', ['name'=>'ProductCard'], ['name'=>'Product']);
        $this->update('{{%parser_type}}', ['name'=>'ProductList'], ['name'=>'Account']);

        return false;
    }
    
}
