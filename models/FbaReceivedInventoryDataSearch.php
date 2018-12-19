<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaReceivedInventoryData;

/**
 * FbaReceivedInventoryDataSearch represents the model behind the search form about `app\models\FbaReceivedInventoryData`.
 */
class FbaReceivedInventoryDataSearch extends FbaReceivedInventoryData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frid_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['received_date', 'fnsku', 'sku', 'product_name', 'quantity', 'fba_shipment_id', 'fulfillment_center_id', 'frid_date'], 'safe'],
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
        $query = FbaReceivedInventoryData::find();

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
            'frid_id' => $this->frid_id,
            'frid_date' => $this->frid_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'received_date', $this->received_date])
            ->andFilterWhere(['like', 'fnsku', $this->fnsku])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'fba_shipment_id', $this->fba_shipment_id])
            ->andFilterWhere(['like', 'fulfillment_center_id', $this->fulfillment_center_id]);

        return $dataProvider;
    }
}
