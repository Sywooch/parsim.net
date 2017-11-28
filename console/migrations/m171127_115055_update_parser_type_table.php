<?php

use yii\db\Migration;

class m171127_115055_update_parser_type_table extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->batchInsert('{{%parser_type}}', ['id','name'], [
            [3,'Task'],
        ]);
        
        return true;
    }

    public function down()
    {
        $this->delete('{{%parser_type}}', ['name'=>'Task']);
        $this->execute('ALTER SEQUENCE parser_type RESTART WITH 2');
        

        return true;
    }
}
