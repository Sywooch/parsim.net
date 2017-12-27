<?php

use yii\db\Migration;

/**
 * Handles adding status to table `parser_type`.
 */
class m171221_153600_add_status_column_to_parser_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('parser_type', 'status', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('parser_type', 'status');
    }
}
