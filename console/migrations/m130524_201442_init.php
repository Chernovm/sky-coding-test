<?php

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
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // Create sky_user table
        $this->createTable('{{%sky_user}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string()->notNull(),
            'lastname' => $this->string()->notNull(),
            'patronymic' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),

            'legal_body' => $this->boolean()->notNull(),
            'private_enterpreneur' => $this->boolean()->notNull(),
            'tax_number' => $this->string(),
            'company_name' => $this->string(),
        ], $tableOptions);

        // Create unique constraint for sky_user's multiple columns
        $this->createIndex('idx_unique_full_name',
            '{{%sky_user}}', 
            ['firstname', 'lastname', 'patronymic'], 
            true);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%sky_user}}');
    }
}
