<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use app\models\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $author_id
 * @property string $author_username
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $published_at
 *
 * @property User $author
 */
class News extends ActiveRecord
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

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 0],
            [['title', 'content', 'author_id', 'author_username'], 'required'],
            [['content'], 'string'],
            [['author_id', 'status'], 'integer'],
            [['created_at', 'updated_at', 'published_at'], 'safe'],
            [['title', 'author_username'], 'string', 'max' => 255],
            [['title'], 'unique'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'author_id' => 'Author ID',
            'author_username' => 'Author Username',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'published_at' => 'Published At',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for related user based on username.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['username' => 'author_username']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // Se la news viene salvata come "pubblicata"
        if ($this->status == 1) {
            // Se è un nuovo record oppure se lo status non era già pubblicato
            if ($insert || $this->getOldAttribute('status') != 1) {
                $this->published_at = new Expression('NOW()');
            }
        } else {
            // Se la news è in bozza, puoi decidere di azzerare published_at oppure lasciarlo invariato.
            $this->published_at = null;
        }

        return true;
    }
}
