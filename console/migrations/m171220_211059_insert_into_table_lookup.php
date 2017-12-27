<?php

use yii\db\Migration;

/**
 * Class m171220_211059_insert_into_table_lookup
 */
class m171220_211059_insert_into_table_lookup extends Migration
{
    public function up()
    {

        $this->batchInsert('{{%lookup}}', ['name', 'code', 'type', 'position'], [
            //Request status
            ['Fixing', 5, 'REQUEST_STATUS',4],
            
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->delete('{{%lookup}}', ['type' => 'REQUEST_STATUS', 'name'=>'Fixing']);
    }
}
