<?php

use yii\db\Schema;
use yii\db\Migration;

class m140916_150445_create_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(), 
            //'username' => $this->string()->notNull(),
            'auth_key' => $this->string(255)->notNull()->unique(),
            'password_hash' => $this->string(255)->notNull(),

            'password_reset_token' => $this->string()->unique(),
            'email_confirm_token' => $this->string()->unique(),
            
            'email' => $this->string(64)->notNull()->unique(),
            'phone' => $this->string(32),
            'first_name' => $this->string(64),
            'last_name' => $this->string(64),

            'avatar_id' => $this->integer(),
            'background_id' => $this->integer(),

            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_by' => $this->integer()->notNull()->defaultValue(1),
            'updated_by' => $this->integer()->notNull()->defaultValue(1),
            
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),

            'role' => $this->string(64)->notNull() . ' DEFAULT \'user\'',
            'description' => $this->string(255),
        ], $tableOptions);

        
        // creates index for column `email`
        $this->createIndex(
            'idx-user-email',
            '{{%user}}',
            'email'
        );

        // creates index for column `status`
        $this->createIndex(
            'idx-user-status',
            '{{%user}}',
            'status'
        );

        // creates index for column `created_by`
        $this->createIndex(
            'fki-user-created-by',
            '{{%user}}',
            'created_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user-created-by',
            '{{%user}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-user-updated-by',
            '{{%user}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user-updated-by',
            '{{%user}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        //добавляю админа с паролем 12345678
        $this->batchInsert('{{%user}}', ['first_name','last_name','auth_key', 'password_hash','email','phone','created_by','updated_by','role','status'],
        [
            //['admin','Павел','Тимофеев', '$2y$13$Z1qBvDkVNNjmRPu7j9dxV.z6NPz7H30gbY3YsWEMo.4WfAuMGJMpq','$2y$13$Z1qBvDkVNNjmRPu7j9dxV.z6NPz7H30gbY3YsWEMo.4WfAuMGJMpq', 'ptimofeev@yandex.ru','+79269483354',1,1,'admin',1],
            ['Павел','Тимофеев', '$2y$13$Z1qBvDkVNNjmRPu7j9dxV.z6NPz7H30gbY3YsWEMo.4WfAuMGJMpq','$2y$13$Z1qBvDkVNNjmRPu7j9dxV.z6NPz7H30gbY3YsWEMo.4WfAuMGJMpq', 'ptimofeev@yandex.ru','+79269483354',1,1,'admin',1],
        
        ]
    );
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
