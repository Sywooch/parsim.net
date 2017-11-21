<?php

use yii\db\Migration;

/**
 * Handles the creation of table `test_response`.
 */
class m171120_130747_create_test_response_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%test_response}}', [
            'id' => $this->primaryKey(),
            'data' => $this->text(),

        ], $tableOptions);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%test_response}}');
    }
}
