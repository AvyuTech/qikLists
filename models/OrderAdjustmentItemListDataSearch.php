<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderAdjustmentItemListData;

/**
 * OrderAdjustmentItemListDataSearch represents the model behind the search form about `app\models\OrderAdjustmentItemListData`.
 */
class OrderAdjustmentItemListDataSearch extends OrderAdjustmentItemListData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oaild_id', 'oaild_quantity', 'oaild_shipment_refund_event_data_id', 'order_adjustment_event_data_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'oaild_status'], 'integer'],
            [['oaild_amazon_order_id', 'oaild_seller_order_id', 'oaild_currency', 'oaild_seller_sku', 'oaild_fnsku', 'oaild_product_description', 'oaild_asin'], 'safe'],
            [['oaild_per_unit_amount', 'oaild_total_amount'], 'number'],
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
        $query = OrderAdjustmentItemListData::find();

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
            'oaild_id' => $this->oaild_id,
            'oaild_quantity' => $this->oaild_quantity,
            'oaild_per_unit_amount' => $this->oaild_per_unit_amount,
            'oaild_total_amount' => $this->oaild_total_amount,
            'oaild_shipment_refund_event_data_id' => $this->oaild_shipment_refund_event_data_id,
            'order_adjustment_event_data_id' => $this->order_adjustment_event_data_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'oaild_status' => $this->oaild_status,
        ]);

        $query->andFilterWhere(['like', 'oaild_amazon_order_id', $this->oaild_amazon_order_id])
            ->andFilterWhere(['like', 'oaild_seller_order_id', $this->oaild_seller_order_id])
            ->andFilterWhere(['like', 'oaild_currency', $this->oaild_currency])
            ->andFilterWhere(['like', 'oaild_seller_sku', $this->oaild_seller_sku])
            ->andFilterWhere(['like', 'oaild_fnsku', $this->oaild_fnsku])
            ->andFilterWhere(['like', 'oaild_product_description', $this->oaild_product_description])
            ->andFilterWhere(['like', 'oaild_asin', $this->oaild_asin]);

        return $dataProvider;
    }
}
