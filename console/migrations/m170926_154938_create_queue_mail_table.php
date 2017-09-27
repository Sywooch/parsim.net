<?php

use yii\db\Migration;

/**
 * Handles the creation of table `queue_mail`.
 */
class m170926_154938_create_queue_mail_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%queue_mail}}', [
            'id' => $this->primaryKey(),
            'subject'=> $this->string(255),
            'swift_message' => $this->text(),

            'attempts'=> $this->integer(),
            'last_attempt_time'=>$this->timestamp(),

            'sent_time'=>$this->timestamp(),
            'time_to_send'=>$this->timestamp()->notNull(),

            'created_at' => $this->timestamp()->notNull(),
  
        ], $tableOptions);

        // creates index for column `sent_time`
        $this->createIndex(
            'ix-queue-mail-sent-time',
            '{{%queue_mail}}',
            'sent_time'
        );

        // creates index for column `time_to_sen`
        $this->createIndex(
            'ix-queue-mail-time-to-sen',
            '{{%queue_mail}}',
            'time_to_send'
        );
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%queue_mail}}');
    }
}
