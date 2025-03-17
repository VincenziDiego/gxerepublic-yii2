<?php

use yii\db\Migration;
use yii\db\Expression;

class m250310_083328_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(255)->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
            'updated_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')),
            'bungieid' => $this->string()->unique(),
            'clan' => $this->string(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1), //0 = bannato, 1 = attivo
            'icon_url' => $this->string()->defaultValue('uploads/default.jpg'), // Nuovo campo per l'icona del profilo
        ]);

        $this->addCommentOnTable('{{%user}}', 'Tabella per la gestione degli utenti');
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}