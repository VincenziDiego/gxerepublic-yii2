<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class User extends ActiveRecord implements IdentityInterface
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public $iconFile;

    /**
     * Specifica il nome della tabella
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    public function rules()
    {
        return [
            // I campi username e email sono obbligatori e vengono “trimmati”
            [['username', 'email'], 'required'],
            [['username', 'email'], 'trim'],

            // Username deve avere una lunghezza minima e massima
            [['username'], 'string', 'min' => 2, 'max' => 255],

            // Email deve essere un indirizzo email valido
            [['email'], 'email'],
            [['email'], 'string', 'max' => 255],

            // Controlla l'unicità di username ed email
            [['username'], 'unique', 'targetClass' => self::class, 'message' => 'Questo username è già in uso.'],
            [['email'], 'unique', 'targetClass' => self::class, 'message' => 'Questo indirizzo email è già in uso.'],

            // I campi aggiuntivi: bungieid e clan
            [['bungieid', 'clan'], 'string', 'max' => 255],
            [['bungieid', 'clan'], 'default', 'value' => null],

            // created_at e updated_at verranno gestiti automaticamente e sono marcati come safe
            [['created_at', 'updated_at'], 'safe'],

            // Il campo status è un intero (usato da yii2-admin per gestire lo stato dell'utente)
            [['status'], 'integer'],

            // Regola per iconFile: opzionale, solo per estensione immagini, dimensione massima, ecc.
            [['iconFile'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024, 'skipOnEmpty' => true],
        ];
    }


    /**
     * Restituisce l'utente in base all'id
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Restituisce l'utente in base al token di accesso (se lo usi)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Se utilizzi token di accesso, aggiungi un campo nella tabella, altrimenti puoi lasciare questo metodo
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Trova un utente in base al nome utente
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Restituisce l'id dell'utente
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Restituisce la chiave di autenticazione
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Valida la chiave di autenticazione
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Valida la password usando il componente di sicurezza di Yii
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    // Nel modello User:
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole('user');
            if ($userRole) {
                $auth->assign($userRole, $this->id);
            }
        }

        if (isset($changedAttributes['username'])) {
            \app\models\News::updateAll(
                ['author_username' => $this->username],
                ['author_id' => $this->id]
            );
        }
    }

    public function getRole()
    {
        return $this->role;
    }
}
