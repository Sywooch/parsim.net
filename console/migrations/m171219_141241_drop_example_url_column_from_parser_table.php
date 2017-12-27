<?php

use yii\db\Migration;

/**
 * Handles dropping example_url from table `parser`.
 */
class m171219_141241_drop_example_url_column_from_parser_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('parser', 'example_url');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('parser', 'example_url', $this->string(512));
    }
}
