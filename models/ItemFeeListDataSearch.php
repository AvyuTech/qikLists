<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemFeeListData;

/**
 * ItemFeeListDataSearch represents the model behind the search form about `app\models\ItemFeeListData`.
 */
class ItemFeeListDataSearch extends ItemFeeListData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ifld_id', 'ifld_shipment_refund_event_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'ifld_status'], 'integer'],
            [['ifld_amazon_order_id', 'ifld_seller_order_id', 'ifld_fee_type', 'ifld_currency', 'ifld_transaction_type', 'ifld_item_type'], 'safe'],
            [['ifld_fee_amount'], 'number'],
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
        $query = ItemFeeListData::find();

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
            'ifld_id' => $this->ifld_id,
            'ifld_fee_amount' => $this->ifld_fee_amount,
            'ifld_shipment_refund_event_id' => $this->ifld_shipment_refund_event_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'ifld_status' => $this->ifld_status,
        ]);

        $query->andFilterWhere(['like', 'ifld_amazon_order_id', $this->ifld_amazon_order_id])
            ->andFilterWhere(['like', 'ifld_seller_order_id', $this->ifld_seller_order_id])
            ->andFilterWhere(['like', 'ifld_fee_type', $this->ifld_fee_type])
            ->andFilterWhere(['like', 'ifld_currency', $this->ifld_currency])
            ->andFilterWhere(['like', 'ifld_transaction_type', $this->ifld_transaction_type])
            ->andFilterWhere(['like', 'ifld_item_type', $this->ifld_item_type]);

        return $dataProvider;
    }
}
