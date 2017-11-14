<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tarif_option_option`.
 */
class m170605_131114_create_tarif_option_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tarif_option}}', [
            'id' => $this->primaryKey(), 
            'tarif_id' => $this->integer()->notNull(),
            
            'title' => $this->string(128)->notNull(),
            'description' => $this->text(),
            'order_num'=>$this->integer(),
            
        ], $tableOptions);

        // creates index for column `tarif_id`
        $this->createIndex(
            'fki-tarif-option-tarif-id',
            '{{%tarif_option}}',
            'tarif_id'
        );
        // add foreign key for table `tarif`
        $this->addForeignKey(
            'fk-tarif-option-tarif-id',
            '{{%tarif_option}}',
            'tarif_id',
            '{{%tarif}}',
            'id',
            'CASCADE'
        );

        $this->batchInsert('{{%tarif_option}}', ['tarif_id','title','order_num'], [
            //free-forever
            [1,'Частота обновлений - раз в день',1],
            [1,'Неограниченное кол-во ссылок',2],
            [1,'Тех. поддержка с 9:00 до 17:00, Пн.-Пт.',3],
            [1,'Добавление новых сайтов - бесплатно',4],
            [1,'Доступ в личный кабинет',5],
            [1,'Доступ по API',6],

            //pay-per-period
            [2,'Частота обновлений - раз в день',1],
            [2,'Неограниченное кол-во ссылок',2],
            [2,'Тех. поддержка с 9:00 до 17:00, Пн.-Пт.',3],
            [2,'Добавление новых сайтов - бесплатно',4],
            [2,'Доступ в личный кабинет',5],
            [2,'Доступ по API',6],

            

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%tarif_option}}');
    }
}
