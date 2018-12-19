<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FbaOrderShipmentDetailReportData;

/**
 * FbaOrderShipmentDetailReportDataSearch represents the model behind the search form about `app\models\FbaOrderShipmentDetailReportData`.
 */
class FbaOrderShipmentDetailReportDataSearch extends FbaOrderShipmentDetailReportData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fosdrd_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['amazon_order_id', 'merchant_order_id', 'shipment_id', 'shipment_item_id', 'amazon_order_item_id', 'merchant_order_item_id', 'purchase_date', 'payments_date', 'shipment_date', 'reporting_date', 'buyer_email', 'buyer_name', 'buyer_phone_number', 'sku', 'product_name', 'quantity_shipped', 'currency', 'item_price', 'item_tax', 'shipping_price', 'shipping_tax', 'gift_wrap_price', 'gift_wrap_tax', 'ship_service_level', 'recipient_name', 'ship_address_1', 'ship_address_2', 'ship_address_3', 'ship_city', 'ship_state', 'ship_postal_code', 'ship_country', 'ship_phone_number', 'bill_address_1', 'bill_address_2', 'bill_address_3', 'bill_city', 'bill_state', 'bill_postal_code', 'bill_country', 'item_promotion_discount', 'ship_promotion_discount', 'carrier', 'tracking_number', 'estimated_arrival_date', 'fulfillment_center_id', 'fulfillment_channel', 'sales_channel', 'fosdrd_date'], 'safe'],
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
        $query = FbaOrderShipmentDetailReportData::find();

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
            'fosdrd_id' => $this->fosdrd_id,
            'fosdrd_date' => $this->fosdrd_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'amazon_order_id', $this->amazon_order_id])
            ->andFilterWhere(['like', 'merchant_order_id', $this->merchant_order_id])
            ->andFilterWhere(['like', 'shipment_id', $this->shipment_id])
            ->andFilterWhere(['like', 'shipment_item_id', $this->shipment_item_id])
            ->andFilterWhere(['like', 'amazon_order_item_id', $this->amazon_order_item_id])
            ->andFilterWhere(['like', 'merchant_order_item_id', $this->merchant_order_item_id])
            ->andFilterWhere(['like', 'purchase_date', $this->purchase_date])
            ->andFilterWhere(['like', 'payments_date', $this->payments_date])
            ->andFilterWhere(['like', 'shipment_date', $this->shipment_date])
            ->andFilterWhere(['like', 'reporting_date', $this->reporting_date])
            ->andFilterWhere(['like', 'buyer_email', $this->buyer_email])
            ->andFilterWhere(['like', 'buyer_name', $this->buyer_name])
            ->andFilterWhere(['like', 'buyer_phone_number', $this->buyer_phone_number])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'quantity_shipped', $this->quantity_shipped])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'item_price', $this->item_price])
            ->andFilterWhere(['like', 'item_tax', $this->item_tax])
            ->andFilterWhere(['like', 'shipping_price', $this->shipping_price])
            ->andFilterWhere(['like', 'shipping_tax', $this->shipping_tax])
            ->andFilterWhere(['like', 'gift_wrap_price', $this->gift_wrap_price])
            ->andFilterWhere(['like', 'gift_wrap_tax', $this->gift_wrap_tax])
            ->andFilterWhere(['like', 'ship_service_level', $this->ship_service_level])
            ->andFilterWhere(['like', 'recipient_name', $this->recipient_name])
            ->andFilterWhere(['like', 'ship_address_1', $this->ship_address_1])
            ->andFilterWhere(['like', 'ship_address_2', $this->ship_address_2])
            ->andFilterWhere(['like', 'ship_address_3', $this->ship_address_3])
            ->andFilterWhere(['like', 'ship_city', $this->ship_city])
            ->andFilterWhere(['like', 'ship_state', $this->ship_state])
            ->andFilterWhere(['like', 'ship_postal_code', $this->ship_postal_code])
            ->andFilterWhere(['like', 'ship_country', $this->ship_country])
            ->andFilterWhere(['like', 'ship_phone_number', $this->ship_phone_number])
            ->andFilterWhere(['like', 'bill_address_1', $this->bill_address_1])
            ->andFilterWhere(['like', 'bill_address_2', $this->bill_address_2])
            ->andFilterWhere(['like', 'bill_address_3', $this->bill_address_3])
            ->andFilterWhere(['like', 'bill_city', $this->bill_city])
            ->andFilterWhere(['like', 'bill_state', $this->bill_state])
            ->andFilterWhere(['like', 'bill_postal_code', $this->bill_postal_code])
            ->andFilterWhere(['like', 'bill_country', $this->bill_country])
            ->andFilterWhere(['like', 'item_promotion_discount', $this->item_promotion_discount])
            ->andFilterWhere(['like', 'ship_promotion_discount', $this->ship_promotion_discount])
            ->andFilterWhere(['like', 'carrier', $this->carrier])
            ->andFilterWhere(['like', 'tracking_number', $this->tracking_number])
            ->andFilterWhere(['like', 'estimated_arrival_date', $this->estimated_arrival_date])
            ->andFilterWhere(['like', 'fulfillment_center_id', $this->fulfillment_center_id])
            ->andFilterWhere(['like', 'fulfillment_channel', $this->fulfillment_channel])
            ->andFilterWhere(['like', 'sales_channel', $this->sales_channel]);

        return $dataProvider;
    }
}
