<?php

use yii\db\Migration;

/**
 * Class m171215_090755_update_example_url_column_in_post_action_table
 */
class m171215_090755_update_example_url_column_in_parser_action_table extends Migration
{
    public function up()
    {
        $this->alterColumn('parser_action', 'example_url',$this->string(512));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->alterColumn('parser_action', 'example_url',$this->string(128));
    }
}
