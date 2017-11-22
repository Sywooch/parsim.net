<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lookup`.
 */
class m170605_122428_create_lookup_table extends Migration
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

        $this->createTable('{{%lookup}}', [
            'id' => $this->primaryKey(), 
            'name' => $this->string(128)->notNull(),
            'code' => $this->integer()->notNull()->defaultValue(1),
            'type' => $this->string(64)->notNull(),
            'position' => $this->integer()
        ], $tableOptions);

        $this->createIndex('idx-lookup-type', '{{%lookup}}', 'type');

        $this->batchInsert('{{%lookup}}', ['name', 'code', 'type', 'position'], [
            //User status
            ['Заблокирован', 0, 'USER_STATUS',0],
            ['Активный', 1, 'USER_STATUS',1],
            ['На проверке', 2, 'USER_STATUS', 2],

            //Tarif type
            ['Free', 0, 'TARIF_TYPE',0],
            ['Cost per Action', 1, 'TARIF_TYPE',1],
            ['Cost per Period', 2, 'TARIF_TYPE',3],

            //Tarif status
            ['Заблокирован', 0, 'TARIF_STATUS',0],
            ['Активный', 1, 'TARIF_STATUS',1],

            //Category type
            ['Parser category', 0, 'CATEGORY_TYPE',0],

            //Loader type
            ['HtmlClient', 0, 'LOADER_TYPE',0],
            ['iMacros', 1, 'LOADER_TYPE',1],

            //Loader status
            ['Ready', 0, 'LOADER_STATUS',0],
            ['Has error', 1, 'LOADER_STATUS',1],
            ['Fixing', 2, 'LOADER_STATUS',2],
            

            //Parser status
            ['Ready', 0, 'PARSER_STATUS',0],
            ['Has error', 1, 'PARSER_STATUS',1],
            ['Fixing', 2, 'PARSER_STATUS',2],

            //Error code
            ['Unknow error', 100, 'ERROR_CODE',0],
            ['Parser not found', 200, 'ERROR_CODE',1],
            ['Parser action not found', 201, 'ERROR_CODE',2],
            ['Parsing error', 202, 'ERROR_CODE',3],
            ['Loader not found', 300, 'ERROR_CODE',4],
            ['Loading error', 301, 'ERROR_CODE',5],

            //Error status
            ['New', 0, 'ERROR_STATUS',0],
            ['In progress', 1, 'ERROR_STATUS',1],
            ['Testing', 2, 'ERROR_STATUS',2],
            ['Fixed', 3, 'ERROR_STATUS',3],
            

            //Request status
            ['Ready', 0, 'REQUEST_STATUS',0],
            ['Processing', 1, 'REQUEST_STATUS',1],
            ['Success', 2, 'REQUEST_STATUS',2],
            ['Error', 3, 'REQUEST_STATUS',3],
            ['Need pay', 4, 'REQUEST_STATUS',3],

            //Response status
            ['Ready', 0, 'RESPONSE_STATUS',0],
            ['Loading', 1, 'RESPONSE_STATUS',1],
            ['Load success', 2, 'RESPONSE_STATUS',2],
            ['Load error', 3, 'RESPONSE_STATUS',3],
            ['Parsing', 4, 'RESPONSE_STATUS',4],
            ['Parse success', 5, 'RESPONSE_STATUS',5],
            ['Parse error', 6, 'RESPONSE_STATUS',6],

            //Order status
            ['NEW', 0, 'ORDER_STAUS',0],
            ['PAID', 1, 'ORDER_STAUS',1],

            //Transactin type
            ['IN', 0, 'TRANSACTION_TYPE',0],
            ['OUT', 1, 'TRANSACTION_TYPE',1],

            //Transactin status
            ['FAIL', 0, 'TRANSACTION_STATUS',0],
            ['SUCCESS', 1, 'TRANSACTION_STATUS',1],

            //Notification type
            ['Need pay', 0, 'NOTIFICATION_TYPE',0],
            

            //Notification status
            ['New', 0, 'NOTIFICATION_STATUS',0],
            ['Readed', 1, 'NOTIFICATION_STATUS',1],

            //Ticket status
            ['Open', 0, 'TICKET_STATUS',0],
            ['Close', 1, 'TICKET_STATUS',1],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%lookup}}');
    }
}
