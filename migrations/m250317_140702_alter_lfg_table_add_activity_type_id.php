<?php

use yii\db\Migration;

class m250317_140702_alter_lfg_table_add_activity_type_id extends Migration
{
    public function safeUp()
    {
        // Aggiungi la colonna activity_type_id alla tabella lfg
        $this->addColumn('{{%lfg}}', 'activity_type_id', $this->integer()->null()->comment('ID del tipo di attività associato'));

        // Aggiungi il foreign key se vuoi garantire l'integrità referenziale
        $this->addForeignKey(
            'fk-lfg-activity_type_id',
            '{{%lfg}}',
            'activity_type_id',
            '{{%activity_type}}',
            'id',
            'SET NULL'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-lfg-activity_type_id', '{{%lfg}}');
        $this->dropColumn('{{%lfg}}', 'activity_type_id');
    }
}
