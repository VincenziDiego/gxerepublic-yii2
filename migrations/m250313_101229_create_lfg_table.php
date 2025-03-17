<?php

use yii\db\Migration;

class m250313_101229_create_lfg_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%lfg}}', [
            'id' => $this->primaryKey(),
            'leader_id' => $this->integer()->notNull()->comment('ID del giocatore creatore (riferimento alla tabella user)'),
            'activity_type' => $this->string(100)->notNull()->comment('Tipo di attività (raid, strike, dungeon, etc.)'),
            'description' => $this->text()->null()->comment('Descrizione e note sull\'attività'),
            'max_players' => $this->integer()->notNull()->comment('Numero massimo di giocatori'),
            'current_players' => $this->text()->null()->comment('Lista dei giocatori attivi (es. JSON o CSV dei bungieid)'),
            'reserve_players' => $this->text()->null()->comment('Lista dei giocatori in riserva'),
            'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('Stato del gruppo: 1 = aperto, 0 = chiuso'),
            'start_time' => $this->timestamp()->null()->comment('Data e ora di inizio attività'),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Data e ora di creazione'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->comment('Data e ora di aggiornamento'),
        ]);

        // Aggiungi il foreign key per leader_id che fa riferimento alla tabella user
        $this->addForeignKey(
            'fk-lfg-leader_id',
            '{{%lfg}}',
            'leader_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addCommentOnTable('{{%lfg}}', 'Tabella per la gestione dei gruppi LFG del clan di Destiny');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-lfg-leader_id', '{{%lfg}}');
        $this->dropTable('{{%lfg}}');
    }
}
