<?php

use yii\db\Migration;

class m250317_134729_create_activity_type_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%activity_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->unique()->comment('Nome della categoria (es. Campagna, Crogiolo, etc.)'),
            'description' => $this->text()->null()->comment('Descrizione della categoria'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%activity_type}}');
    }
}
