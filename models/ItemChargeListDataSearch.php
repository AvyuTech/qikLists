<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemChargeListData;

/**
 * ItemChargeListDataSearch represents the model behind the search form about `app\models\ItemChargeListData`.
 */
class ItemChargeListDataSearch extends ItemChargeListData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icld_id', 'icld_shipment_refund_event_data_id', 'updated_at', 'created_at', 'created_by', 'updated_by', 'icld_status'], 'integer'],
            [['icld_amazon_order_id', 'icld_seller_order_id', 'icld_item_charge_type', 'icld_currency', 'icld_transaction_type', 'icld_item_type'], 'safe'],
            [['icld_charge_amount'], 'number'],
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
        $query = ItemChargeListData::find();

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
            'icld_id' => $this->icld_id,
            'icld_charge_amount' => $this->icld_charge_amount,
            'icld_shipment_refund_event_data_id' => $this->icld_shipment_refund_event_data_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'icld_status' => $this->icld_status,
        ]);

        $query->andFilterWhere(['like', 'icld_amazon_order_id', $this->icld_amazon_order_id])
            ->andFilterWhere(['like', 'icld_seller_order_id', $this->icld_seller_order_id])
            ->andFilterWhere(['like', 'icld_item_charge_type', $this->icld_item_charge_type])
            ->andFilterWhere(['like', 'icld_currency', $this->icld_currency])
            ->andFilterWhere(['like', 'icld_transaction_type', $this->icld_transaction_type])
            ->andFilterWhere(['like', 'icld_item_type', $this->icld_item_type]);

        return $dataProvider;
    }
}
