<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Lfg extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%lfg}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('CURRENT_TIMESTAMP'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['leader_id', 'activity_type', 'max_players', 'start_time'], 'required'],
            [['leader_id', 'max_players', 'status'], 'integer'],
            [['description', 'current_players', 'reserve_players'], 'string'],
            [['start_time', 'created_at', 'updated_at'], 'safe'],
            [['activity_type'], 'string', 'max' => 100],
            ['start_time', 'validateStartTime'],
        ];
    }

    /**
     * Custom validator per start_time: deve essere strettamente nel futuro.
     */
    public function validateStartTime($attribute, $params)
    {
        if (empty($this->$attribute)) {
            $this->addError($attribute, 'Il campo Data e ora di inizio è obbligatorio.');
            return;
        }

        // Converte il valore dal formato datetime-local al formato DB
        $date = \DateTime::createFromFormat('Y-m-d\TH:i', $this->$attribute);
        if ($date) {
            $this->$attribute = $date->format('Y-m-d H:i:s');
        } else {
            $this->addError($attribute, 'Il formato della data non è valido.');
            return;
        }

        if (strtotime($this->$attribute) <= time()) {
            $this->addError($attribute, 'L\'orario di inizio deve essere nel futuro.');
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'leader_id' => 'ID Leader',
            'activity_type' => 'Attività',
            'description' => 'Descrizione',
            'max_players' => 'Numero massimo di giocatori',
            'current_players' => 'Giocatori attivi',
            'reserve_players' => 'Giocatori in riserva',
            'status' => 'Stato (1=Aperto, 0=Chiuso)',
            'start_time' => 'Data e ora di inizio',
            'created_at' => 'Creato il',
            'updated_at' => 'Ultimo aggiornamento',
        ];
    }

    /**
     * Relazione con il model User (per il leader)
     */
    public function getLeader()
    {
        return $this->hasOne(User::class, ['id' => 'leader_id']);
    }

    /**
     * Verifica se l'utente può modificare l'LFG:
     * deve essere il leader oppure avere il ruolo admin (controlla con RBAC o una proprietà custom).
     */
    public function canEdit($userId)
    {
        $user = Yii::$app->user->identity;
        // Utilizza il sistema RBAC oppure controlla una proprietà custom se esiste (es. $user->role)
        if ($user->id == $this->leader_id || Yii::$app->user->can('admin')) {
            return true;
        }
        return false;
    }

    /**
     * Metodo per aggiungere un giocatore all'LFG.
     * @param string $bungieId
     * @param bool $toReserve se true aggiunge direttamente in riserva, altrimenti nella lista attiva
     * @return bool
     */
    public function join($bungieId, $toReserve = false)
    {
        // Inizializza le liste come array (se non ci sono dati, usa array vuoti)
        $current_players = $this->current_players ? array_map('trim', explode(',', $this->current_players)) : [];
        $reserve_players = $this->reserve_players ? array_map('trim', explode(',', $this->reserve_players)) : [];

        // Controlla se l'utente è già presente nelle liste
        $inCurrent = in_array($bungieId, $current_players);
        $inReserve = in_array($bungieId, $reserve_players);

        if ($toReserve) {
            // Opzione "Unisciti alle riserve"
            // Se è in current, rimuovilo (lo spostiamo in riserva)
            if ($inCurrent) {
                $current_players = array_filter($current_players, function ($id) use ($bungieId) {
                    return $id !== $bungieId;
                });
            }
            if (!$inReserve) {
                $reserve_players[] = $bungieId;
            }
        } else {
            // Opzione "Unisciti" normale: aggiungi solo se non già presente in nessuna lista
            if (!$inCurrent && !$inReserve) {
                if (count($current_players) < $this->max_players) {
                    $current_players[] = $bungieId;
                } else {
                    // Se il gruppo è pieno, aggiungi automaticamente in riserve
                    $reserve_players[] = $bungieId;
                }
            }
        }

        // Aggiorna i campi come CSV
        $this->current_players = implode(',', $current_players);
        $this->reserve_players = implode(',', $reserve_players);

        // Usa save(false) per bypassare le validazioni non rilevanti per questa operazione
        if (!$this->save(false)) {
            Yii::error("LFG join() error: " . print_r($this->getErrors(), true), __METHOD__);
            return false;
        }
        return true;
    }

    /**
     * Rimuove un giocatore (sia dalla lista attiva che da quella delle riserve)
     * @param string $bungieId
     * @return bool
     */
    public function removePlayer($bungieId)
    {
        $current_players = $this->current_players ? array_map('trim', explode(',', $this->current_players)) : [];
        $reserve_players = $this->reserve_players ? array_map('trim', explode(',', $this->reserve_players)) : [];

        $current_players = array_filter($current_players, function ($id) use ($bungieId) {
            return $id !== $bungieId;
        });
        $reserve_players = array_filter($reserve_players, function ($id) use ($bungieId) {
            return $id !== $bungieId;
        });

        $this->current_players = implode(',', $current_players);
        $this->reserve_players = implode(',', $reserve_players);

        if (!$this->save(false)) {
            Yii::error("LFG removePlayer() error: " . print_r($this->getErrors(), true), __METHOD__);
            return false;
        }
        return true;
    }

    public function autoClose()
    {
        // Se start_time è definito e l'orario attuale è maggiore o uguale a start_time
        // e lo status non è già chiuso (0), allora chiudi l'LFG.
        if ($this->start_time !== null && strtotime($this->start_time) <= time() && $this->status != 0) {
            $this->status = 0;
            $this->save(false);
        }
    }
}
