<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubscriptionComponent;

/**
 * SubscriptionComponentSearch represents the model behind the search form about `app\models\SubscriptionComponent`.
 */
class SubscriptionComponentSearch extends SubscriptionComponent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subscription_component_id', 'active'], 'integer'],
            [['component_name', 'component_description', 'created_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SubscriptionComponent::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'subscription_component_id' => $this->subscription_component_id,
            'created_date' => $this->created_date,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'component_name', $this->component_name])
            ->andFilterWhere(['like', 'component_description', $this->component_description]);

        return $dataProvider;
    }
}
