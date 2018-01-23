<?php

use yii\db\Migration;

/**
 * Handles adding alias to table `transaction`.
 */
class m180123_084051_add_alias_column_to_transaction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('transaction', 'alias', $this->string(16));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('transaction', 'alias');
    }
}
