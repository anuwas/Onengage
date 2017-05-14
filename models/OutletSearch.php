<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Outlet;

/**
 * OutletSearch represents the model behind the search form about `app\models\Outlet`.
 */
class OutletSearch extends Outlet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['outlet_id', 'brand_id', 'active'], 'integer'],
            [['outlet_name', 'outlet_address', 'outlet_email', 'outlet_mobile', 'outlet_contactperson', 'created_date'], 'safe'],
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
        $query = Outlet::find();

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
            'outlet_id' => $this->outlet_id,
            'brand_id' => $this->brand_id,
            'created_date' => $this->created_date,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'outlet_name', $this->outlet_name])
            ->andFilterWhere(['like', 'outlet_address', $this->outlet_address])
            ->andFilterWhere(['like', 'outlet_email', $this->outlet_email])
            ->andFilterWhere(['like', 'outlet_mobile', $this->outlet_mobile])
            ->andFilterWhere(['like', 'outlet_contactperson', $this->outlet_contactperson]);

        return $dataProvider;
    }
}
