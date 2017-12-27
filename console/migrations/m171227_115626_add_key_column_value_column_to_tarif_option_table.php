<?php

use yii\db\Migration;

/**
 * Handles adding key_column_value to table `tarif_option`.
 */
class m171227_115626_add_key_column_value_column_to_tarif_option_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('tarif_option', 'key', $this->string(64));
        $this->addColumn('tarif_option', 'value', $this->string(128));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('tarif_option', 'key');
        $this->dropColumn('tarif_option', 'value');
    }
}
