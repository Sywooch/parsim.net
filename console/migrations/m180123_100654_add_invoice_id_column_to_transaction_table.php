<?php

use yii\db\Migration;

/**
 * Handles adding invoiceId to table `transaction`.
 */
class m180123_100654_add_invoice_id_column_to_transaction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('transaction', 'invoice_id', $this->string(16));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('transaction', 'invoice_id');
    }
}
