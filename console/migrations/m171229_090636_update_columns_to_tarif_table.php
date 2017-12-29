<?php

use yii\db\Migration;

/**
 * Class m171229_090636_add_columns_to_tarif_table
 */
class m171229_090636_update_columns_to_tarif_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->renameColumn('tarif', 'duration', 'time_limit'); //
        $this->renameColumn('tarif', 'qty', 'pars_limit');

        $this->addColumn('tarif', 'time_unit', $this->string(64));
        $this->addColumn('tarif', 'host_limit', $this->integer());

        $this->addColumn('tarif', 'extra_host_price', $this->money());
        $this->addColumn('tarif', 'extra_pars_price', $this->money());

        $this->addColumn('tarif', 'page_limit', $this->integer());

        $this->addColumn('tarif', 'pars_freq', $this->integer());
        $this->addColumn('tarif', 'can_export', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('tarif', 'api_access', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->renameColumn('tarif', 'time_limit', 'duration'); //
        $this->renameColumn('tarif', 'pars_limit', 'qty');

        $this->dropColumn('tarif', 'time_unit');
        $this->dropColumn('tarif', 'host_limit');

        $this->dropColumn('tarif', 'extra_host_price');
        $this->dropColumn('tarif', 'extra_pars_price');

        $this->dropColumn('tarif', 'page_limit');

        $this->dropColumn('tarif', 'pars_freq');
        $this->dropColumn('tarif', 'can_export');
        $this->dropColumn('tarif', 'api_access');
        
    }
}
