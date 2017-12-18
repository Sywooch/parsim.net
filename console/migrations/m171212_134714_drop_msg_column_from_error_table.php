<?php

use yii\db\Migration;

/**
 * Handles dropping msg from table `error`.
 */
class m171212_134714_drop_msg_column_from_error_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('error', 'msg');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('error', 'msg', $this->text());
    }
}
