<?php

use yii\db\Migration;

/**
 * Handles adding created_at_column_updated_at to table `tarif`.
 */
class m171222_132448_add_created_at_column_updated_at_column_to_tarif_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('tarif', 'created_at', $this->integer());
        $this->addColumn('tarif', 'updated_at', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('tarif', 'created_at');
        $this->dropColumn('tarif', 'updated_at');
    }
}
