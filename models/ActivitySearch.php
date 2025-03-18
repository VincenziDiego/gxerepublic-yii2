<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Activity;

/**
 * ActivitySearch represents the model behind the search form of `app\models\Activity`.
 */
class ActivitySearch extends Activity
{
    // Attributo virtuale per cercare per nome della categoria
    public $category_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'default_players'], 'integer'],
            [['name', 'description', 'category_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        // Eseguiamo un join con la relazione 'activityType' per poter filtrare per nome della categoria.
        $query = Activity::find()->joinWith('activityType');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Abilita l'ordinamento per la colonna "category_name"
        $dataProvider->sort->attributes['category_name'] = [
            'asc' => ['activity_type.name' => SORT_ASC],
            'desc' => ['activity_type.name' => SORT_DESC],
        ];

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Applica i filtri per gli altri campi
        $query->andFilterWhere([
            'activity.id' => $this->id,
            'activity.default_players' => $this->default_players,
        ]);

        $query->andFilterWhere(['like', 'activity.name', $this->name])
            ->andFilterWhere(['like', 'activity.description', $this->description])
            // Filtra per il nome della categoria dalla tabella activity_type
            ->andFilterWhere(['like', 'activity_type.name', $this->category_name]);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'category_name' => 'Category',
        ]);
    }
}
