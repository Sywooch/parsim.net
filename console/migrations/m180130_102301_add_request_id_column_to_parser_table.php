<?php

use yii\db\Migration;

/**
 * Handles adding request_id to table `parser`.
 */
class m180130_102301_add_request_id_column_to_parser_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('parser', 'request_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('parser', 'request_id');
    }
}
