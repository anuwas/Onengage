<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Merchant;

/**
 * MerchantSearch represents the model behind the search form about `app\models\Merchant`.
 */
class MerchantSearch extends Merchant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_id', 'outlet_no', 'active'], 'integer'],
            [['merchant_name', 'merchant_address', 'nature_of_business', 'created_date'], 'safe'],
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
        $query = Merchant::find();

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
            'merchant_id' => $this->merchant_id,
            'outlet_no' => $this->outlet_no,
            'active' => $this->active,
            'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'merchant_name', $this->merchant_name])
            ->andFilterWhere(['like', 'merchant_address', $this->merchant_address])
            ->andFilterWhere(['like', 'nature_of_business', $this->nature_of_business]);

        return $dataProvider;
    }
}
