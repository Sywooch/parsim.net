<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tarif`.
 */
class m170605_131113_create_tarif_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tarif}}', [
            'id' => $this->primaryKey(), 
            'type' => $this->integer()->notNull()->defaultValue(0),
            
            'alias' => $this->string(128)->notNull(),
            'name' => $this->string(128)->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0),
            'visible' => $this->integer()->notNull()->defaultValue(1),

            'duration' => $this->string(32),
            'price'=>$this->float(),
            'qty'=>$this->integer(),
            
            
        ], $tableOptions);

        $this->batchInsert('{{%tarif}}', ['alias','name', 'type', 'status', 'duration', 'price','qty'], [
            //User status
            //['','Demo', 0, 1, null,null],
            ['free-forever','Free Forever', 0, 1, null,null,1],
            ['pay-per-period','Per Month', 2, 1, '1 month',300,null],
            ['pay-per-action','Per Action', 1, 1, null,0.1,null],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%tarif}}');
    }
}
