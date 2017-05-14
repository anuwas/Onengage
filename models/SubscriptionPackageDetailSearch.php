<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubscriptionPackageDetail;

/**
 * SubscriptionPackageDetailSearch represents the model behind the search form about `app\models\SubscriptionPackageDetail`.
 */
class SubscriptionPackageDetailSearch extends SubscriptionPackageDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subscription_package_detail_id', 'subscription_package_id', 'subscription_component_id', 'quantity'], 'integer'],
            [['price'], 'number'],
            [['validto', 'created_date', 'active'], 'safe'],
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
        $query = SubscriptionPackageDetail::find();

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
            'subscription_package_detail_id' => $this->subscription_package_detail_id,
            'subscription_package_id' => $this->subscription_package_id,
            'subscription_component_id' => $this->subscription_component_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'validto' => $this->validto,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
