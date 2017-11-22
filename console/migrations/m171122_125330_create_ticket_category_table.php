<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ticket_category`.
 */
class m171122_125330_create_ticket_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%ticket_category}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(256)->notNull(),
        ], $tableOptions);

        $this->batchInsert('{{%ticket_category}}', ['name'],
            [
                ['В системе нет нужного парсера'],
                ['Парсер выдает слишком мало информации'],
                ['Ошибка в работе парсера'],
                ['Вопрос по взаиморасчетам'],
                ['Прочее'],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ticket_category}}');
    }
}
