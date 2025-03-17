<?php

use yii\db\Migration;
use yii\db\Expression;

class m250310_133045_create_news_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'content' => $this->text()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'author_username' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0), // 0 = bozza, 1 = pubblicata
            'created_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP')),
            'updated_at' => $this->timestamp()->notNull()->defaultValue(new Expression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')),
            'published_at' => $this->timestamp()->null()->defaultValue(null),
        ]);

        // Aggiungi una foreign key su author_id se necessario
        $this->addForeignKey(
            'fk-news-author',
            '{{%news}}',
            'author_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-news-author', '{{%news}}');
        $this->dropTable('{{%news}}');
    }
}
