<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Questo è il modello per la tabella "activity_type".
 *
 * @property int $id
 * @property string $name Nome della categoria (es. Campagna, Raid, ecc.)
 * @property string|null $description Descrizione della categoria
 */
class ActivityType extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_type}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Categoria',
            'description' => 'Descrizione',
        ];
    }
}
