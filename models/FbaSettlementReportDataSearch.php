<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaSettlementReportData;

/**
 * FbaSettlementReportDataSearch represents the model behind the search form about `app\models\FbaSettlementReportData`.
 */
class FbaSettlementReportDataSearch extends FbaSettlementReportData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fsrd_diff_days', 'fsrd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['settlement_id', 'settlement_start_date', 'settlement_end_date', 'deposit_date', 'total_amount', 'currency', 'transaction_type', 'order_id', 'merchant_order_id', 'adjustment_id', 'shipment_id', 'marketplace_name', 'shipment_fee_type', 'shipment_fee_amount', 'order_fee_type', 'order_fee_amount', 'fulfillment_id', 'posted_date', 'order_item_code', 'merchant_order_item_id', 'merchant_adjustment_item_id', 'sku', 'quantity_purchased', 'price_type', 'price_amount', 'item_related_fee_type', 'item_related_fee_amount', 'misc_fee_amount', 'other_fee_amount', 'other_fee_reason_description', 'promotion_id', 'promotion_type', 'promotion_amount', 'direct_payment_type', 'direct_payment_amount', 'other_amount', 'fsrd_date'], 'safe'],
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
        $query = FbaSettlementReportData::find();

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
            'fsrd_id' => $this->fsrd_id,
            'fsrd_date' => $this->fsrd_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'fsrd_diff_days' => $this->fsrd_diff_days,
        ]);

        $query->andFilterWhere(['like', 'settlement_id', $this->settlement_id])
            ->andFilterWhere(['like', 'settlement_start_date', $this->settlement_start_date])
            ->andFilterWhere(['like', 'settlement_end_date', $this->settlement_end_date])
            ->andFilterWhere(['like', 'deposit_date', $this->deposit_date])
            ->andFilterWhere(['like', 'total_amount', $this->total_amount])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'transaction_type', $this->transaction_type])
            ->andFilterWhere(['like', 'order_id', $this->order_id])
            ->andFilterWhere(['like', 'merchant_order_id', $this->merchant_order_id])
            ->andFilterWhere(['like', 'adjustment_id', $this->adjustment_id])
            ->andFilterWhere(['like', 'shipment_id', $this->shipment_id])
            ->andFilterWhere(['like', 'marketplace_name', $this->marketplace_name])
            ->andFilterWhere(['like', 'shipment_fee_type', $this->shipment_fee_type])
            ->andFilterWhere(['like', 'shipment_fee_amount', $this->shipment_fee_amount])
            ->andFilterWhere(['like', 'order_fee_type', $this->order_fee_type])
            ->andFilterWhere(['like', 'order_fee_amount', $this->order_fee_amount])
            ->andFilterWhere(['like', 'fulfillment_id', $this->fulfillment_id])
            ->andFilterWhere(['like', 'posted_date', $this->posted_date])
            ->andFilterWhere(['like', 'order_item_code', $this->order_item_code])
            ->andFilterWhere(['like', 'merchant_order_item_id', $this->merchant_order_item_id])
            ->andFilterWhere(['like', 'merchant_adjustment_item_id', $this->merchant_adjustment_item_id])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'quantity_purchased', $this->quantity_purchased])
            ->andFilterWhere(['like', 'price_type', $this->price_type])
            ->andFilterWhere(['like', 'price_amount', $this->price_amount])
            ->andFilterWhere(['like', 'item_related_fee_type', $this->item_related_fee_type])
            ->andFilterWhere(['like', 'item_related_fee_amount', $this->item_related_fee_amount])
            ->andFilterWhere(['like', 'misc_fee_amount', $this->misc_fee_amount])
            ->andFilterWhere(['like', 'other_fee_amount', $this->other_fee_amount])
            ->andFilterWhere(['like', 'other_fee_reason_description', $this->other_fee_reason_description])
            ->andFilterWhere(['like', 'promotion_id', $this->promotion_id])
            ->andFilterWhere(['like', 'promotion_type', $this->promotion_type])
            ->andFilterWhere(['like', 'promotion_amount', $this->promotion_amount])
            ->andFilterWhere(['like', 'direct_payment_type', $this->direct_payment_type])
            ->andFilterWhere(['like', 'direct_payment_amount', $this->direct_payment_amount])
            ->andFilterWhere(['like', 'other_amount', $this->other_amount]);

        return $dataProvider;
    }
}
