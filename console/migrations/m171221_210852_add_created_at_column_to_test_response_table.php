<?php

use yii\db\Migration;

/**
 * Handles adding created_at to table `test_response`.
 */
class m171221_210852_add_created_at_column_to_test_response_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('test_response', 'created_at', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('test_response', 'created_at');
    }
}
