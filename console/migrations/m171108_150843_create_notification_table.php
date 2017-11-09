<?php

use yii\db\Migration;

/**
 * Handles the creation of table `notification`.
 */
class m171108_150843_create_notification_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),

            'user_id' => $this->integer()->notNull(), 

            'type' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->integer()->notNull()->defaultValue(0),
            
            'msg' => $this->text(),

            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),

        ], $tableOptions);

        // creates index for column `user_id`
        $this->createIndex(
            'fki-notification-user-id',
            '{{%notification}}',
            'user_id'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-notification-user-id',
            '{{%notification}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%notification}}');
    }
}
