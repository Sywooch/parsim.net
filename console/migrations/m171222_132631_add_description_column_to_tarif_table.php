<?php

use yii\db\Migration;

/**
 * Handles adding description to table `tarif`.
 */
class m171222_132631_add_description_column_to_tarif_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('tarif', 'description', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('tarif', 'description');
    }
}
