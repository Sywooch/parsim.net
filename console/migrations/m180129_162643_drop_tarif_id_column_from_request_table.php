<?php

use yii\db\Migration;

/**
 * Handles dropping tarif_id from table `request`.
 */
class m180129_162643_drop_tarif_id_column_from_request_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('request', 'tarif_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('request', 'tarif_id', $this->integer());
    }
}
