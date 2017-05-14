<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubscriptionPackage;

/**
 * SubscriptionPackageSearch represents the model behind the search form about `app\models\SubscriptionPackage`.
 */
class SubscriptionPackageSearch extends SubscriptionPackage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subscription_package_id', 'active'], 'integer'],
            [['subscription_package_name', 'subscription_package_description', 'validto', 'created_date'], 'safe'],
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
        $query = SubscriptionPackage::find();

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
            'subscription_package_id' => $this->subscription_package_id,
            'validto' => $this->validto,
            'created_date' => $this->created_date,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'subscription_package_name', $this->subscription_package_name])
            ->andFilterWhere(['like', 'subscription_package_description', $this->subscription_package_description]);

        return $dataProvider;
    }
}
