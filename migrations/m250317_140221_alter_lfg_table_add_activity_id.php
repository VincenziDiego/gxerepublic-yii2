<?php

use yii\db\Migration;

class m250317_140221_alter_lfg_table_add_activity_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    // In una migration di aggiornamento (mYYYYMMDD_HHmmss_alter_lfg_table_add_activity_id.php)
    public function safeUp()
    {
        $this->addColumn('{{%lfg}}', 'activity_id', $this->integer()->null()->comment('ID dell\'attività associata'));

        // Aggiungi la foreign key
        $this->addForeignKey(
            'fk-lfg-activity_id',
            '{{%lfg}}',
            'activity_id',
            '{{%activity}}',
            'id',
            'SET NULL'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-lfg-activity_id', '{{%lfg}}');
        $this->dropColumn('{{%lfg}}', 'activity_id');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250317_140221_alter_lfg_table_add_activity_id cannot be reverted.\n";

        return false;
    }
    */
}
