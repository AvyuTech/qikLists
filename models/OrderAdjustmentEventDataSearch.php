<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderAdjustmentEventData;

/**
 * OrderAdjustmentEventDataSearch represents the model behind the search form about `app\models\OrderAdjustmentEventData`.
 */
class OrderAdjustmentEventDataSearch extends OrderAdjustmentEventData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oaed_id', 'oaed_shipment_refund_event_data_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'oaed_status'], 'integer'],
            [['oaed_amazon_order_id', 'oaed_seller_order_id', 'oaed_adjustment_type', 'oaed_currency'], 'safe'],
            [['oaed_amount'], 'number'],
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
        $query = OrderAdjustmentEventData::find();

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
            'oaed_id' => $this->oaed_id,
            'oaed_amount' => $this->oaed_amount,
            'oaed_shipment_refund_event_data_id' => $this->oaed_shipment_refund_event_data_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'oaed_status' => $this->oaed_status,
        ]);

        $query->andFilterWhere(['like', 'oaed_amazon_order_id', $this->oaed_amazon_order_id])
            ->andFilterWhere(['like', 'oaed_seller_order_id', $this->oaed_seller_order_id])
            ->andFilterWhere(['like', 'oaed_adjustment_type', $this->oaed_adjustment_type])
            ->andFilterWhere(['like', 'oaed_currency', $this->oaed_currency]);

        return $dataProvider;
    }
}
