<?php

use yii\db\Migration;

/**
 * Handles adding begin_column_end to table `order`.
 */
class m171222_164144_add_begin_column_end_column_to_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('order', 'begin', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('order', 'end', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('order', 'begin');
        $this->dropColumn('order', 'end');
    }
}
