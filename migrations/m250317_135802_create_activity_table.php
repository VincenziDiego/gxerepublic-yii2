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

        // Inserisci alcuni esempi di attività per ogni categoria (questo è un esempio, adatta in base alle tue esigenze)
        $this->batchInsert('{{%activity}}', ['activity_type_id', 'name', 'default_players', 'description'], [
            // Campagna
            [1, 'Test Campagna', 3, 'Attività campagna'],
            // Crogiolo
            [2, 'Test Crogiolo', 6, 'Attività crogiolo'],
            // Dungeon
            [3, 'Test Dungeon', 3, 'Dungeon'],
            // Azzardo
            [4, 'Test Azzardo', 3, 'Attività di azzardo'],
            // Raid
            [5, 'Test Raid', 6, 'Raid epico'],
            // Stagionale
            [6, 'Test Stagionale', 3, 'Attività stagionale'],
            // Avanguardia
            [7, 'Test Avanguardia', 3, 'Attività di avanguardia'],
            // Altro
            [8, 'test altro', 6, 'Altre attività'],
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-activity-activity_type_id', '{{%activity}}');
        $this->dropTable('{{%activity}}');
    }
}
