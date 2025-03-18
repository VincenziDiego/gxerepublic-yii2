<?php

use yii\db\Migration;

class m250317_135802_create_activity_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%activity}}', [
            'id' => $this->primaryKey(),
            'activity_type_id' => $this->integer()->notNull()->comment('FK alla categoria di attività'),
            'name' => $this->string(100)->notNull()->comment('Nome dell\'attività (titolo)'),
            'default_players' => $this->integer()->notNull()->comment('Numero di giocatori predefinito per questa attività'),
            'description' => $this->text()->null()->comment('Descrizione dell\'attività'),
        ]);

        // Aggiungi la foreign key per activity_type_id
        $this->addForeignKey(
            'fk-activity-activity_type_id',
            '{{%activity}}',
            'activity_type_id',
            '{{%activity_type}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-activity-activity_type_id', '{{%activity}}');
        $this->dropTable('{{%activity}}');
    }
}
