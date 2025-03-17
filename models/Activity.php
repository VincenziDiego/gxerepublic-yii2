<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Questo è il modello per la tabella "activity".
 *
 * @property int $id
 * @property int $activity_type_id ID della categoria a cui appartiene l'attività
 * @property string $name Nome dell'attività
 * @property int $default_players Numero di giocatori predefinito per questa attività
 * @property string|null $description Descrizione dell'attività
 */
class Activity extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity}}';
    }

    public function rules()
    {
        return [
            [['activity_type_id', 'name', 'default_players'], 'required'],
            [['activity_type_id', 'default_players'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_type_id' => 'Categoria',
            'name' => 'Attività',
            'default_players' => 'Numero di giocatori predefinito',
            'description' => 'Descrizione',
        ];
    }

    public function getActivityType()
    {
        return $this->hasOne(ActivityType::class, ['id' => 'activity_type_id']);
    }
}
