<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NULL',
            'avatar' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createTable('{{%post}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(255) SET utf8 NOT NULL',
            'slug' => Schema::TYPE_STRING . '(255) NOT NULL',
            'image_big' => Schema::TYPE_STRING . '(45) DEFAULT NULL',
            'image_medium' => Schema::TYPE_STRING . '(45) DEFAULT NULL',
            'post' => 'logtext CHARACTER SET utf8',
            'owner_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'public_from' =>  'datetime DEFAULT NULL',
            'create_time' => 'datetime DEFAULT NULL',
            'update_time' => 'datetime DEFAULT NULL',
        ], $tableOptions);
        $this->createIndex('slug_uk','{{%post}}','slug',true);
        $this->addForeignKey('owner_id_idx','{{%post}}','owner_id','{{%user}}','id');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%post}}');
    }
}
