<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m170605_131112_create_image_table extends Migration
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
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            
            'name' => $this->string(255)->notNull(),
            'src' => $this->string(255)->notNull(),
            'size' => $this->integer()->notNull(),
            'description' => $this->text(),

            'status' => $this->integer()->notNull()->defaultValue(1),

            'width' => $this->integer()->notNull()->defaultValue(0),
            'height' => $this->integer()->notNull()->defaultValue(0),
            'crop_x' => $this->integer()->notNull()->defaultValue(0),
            'crop_y' => $this->integer()->notNull()->defaultValue(0),
            'crop_width' => $this->integer()->notNull()->defaultValue(0),
            'crop_height' => $this->integer()->notNull()->defaultValue(0),

            'created_by' => $this->integer()->notNull()->defaultValue(1),
            'updated_by' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            'fki-image-created-by',
            '{{%image}}',
            'created_by'
        );
        
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-images-created-by',
            '{{%image}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'fki-images-updated-by',
            '{{%image}}',
            'updated_by'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-images-updated-by',
            '{{%image}}',
            'updated_by',
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
        $this->dropTable('{{%image}}');
    }
}
