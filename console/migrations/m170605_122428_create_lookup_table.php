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

            //Task type
            ['Project', 0, 'TASK_TYPE',0],
            ['Task', 1, 'TASK_TYPE',1],

            //Project status
            ['New', 0, 'PROJECT_STATUS',0],
            ['Enabled', 1, 'PROJECT_STATUS',1],
            ['Desabled', 2, 'PROJECT_STATUS',2],

            //Task status
            ['New', 0, 'TASK_STATUS',0],
            ['Ready to load', 1, 'TASK_STATUS',1],
            ['Loading', 2, 'TASK_STATUS',2],
            ['Ready to parse', 3, 'TASK_STATUS',3],
            ['Parsing', 4, 'TASK_STATUS',4],
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
