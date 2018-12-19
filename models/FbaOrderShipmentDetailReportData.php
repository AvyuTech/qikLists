<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_order_shipment_detail_report_data".
 *
 * @property integer $fosdrd_id
 * @property string $amazon_order_id
 * @property string $merchant_order_id
 * @property string $shipment_id
 * @property string $shipment_item_id
 * @property string $amazon_order_item_id
 * @property string $merchant_order_item_id
 * @property string $purchase_date
 * @property string $payments_date
 * @property string $shipment_date
 * @property string $reporting_date
 * @property string $buyer_email
 * @property string $buyer_name
 * @property string $buyer_phone_number
 * @property string $sku
 * @property string $product_name
 * @property string $quantity_shipped
 * @property string $currency
 * @property string $item_price
 * @property string $item_tax
 * @property string $shipping_price
 * @property string $shipping_tax
 * @property string $gift_wrap_price
 * @property string $gift_wrap_tax
 * @property string $ship_service_level
 * @property string $recipient_name
 * @property string $ship_address_1
 * @property string $ship_address_2
 * @property string $ship_address_3
 * @property string $ship_city
 * @property string $ship_state
 * @property string $ship_postal_code
 * @property string $ship_country
 * @property string $ship_phone_number
 * @property string $bill_address_1
 * @property string $bill_address_2
 * @property string $bill_address_3
 * @property string $bill_city
 * @property string $bill_state
 * @property string $bill_postal_code
 * @property string $bill_country
 * @property string $item_promotion_discount
 * @property string $ship_promotion_discount
 * @property string $carrier
 * @property string $tracking_number
 * @property string $estimated_arrival_date
 * @property string $fulfillment_center_id
 * @property string $fulfillment_channel
 * @property string $sales_channel
 * @property string $fosdrd_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class FbaOrderShipmentDetailReportData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_order_shipment_detail_report_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fosdrd_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['amazon_order_id', 'merchant_order_id', 'shipment_id', 'shipment_item_id', 'amazon_order_item_id', 'merchant_order_item_id', 'purchase_date', 'payments_date', 'shipment_date', 'reporting_date', 'buyer_email', 'buyer_name', 'buyer_phone_number', 'sku', 'product_name', 'quantity_shipped', 'currency', 'item_price', 'item_tax', 'shipping_price', 'shipping_tax', 'gift_wrap_price', 'gift_wrap_tax', 'ship_service_level', 'recipient_name', 'ship_address_1', 'ship_address_2', 'ship_address_3', 'ship_city', 'ship_state', 'ship_postal_code', 'ship_country', 'ship_phone_number', 'bill_address_1', 'bill_address_2', 'bill_address_3', 'bill_city', 'bill_state', 'bill_postal_code', 'bill_country', 'item_promotion_discount', 'ship_promotion_discount', 'carrier', 'tracking_number', 'estimated_arrival_date', 'fulfillment_center_id', 'fulfillment_channel', 'sales_channel'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fosdrd_id' => 'Fosdrd ID',
            'amazon_order_id' => 'Amazon Order ID',
            'merchant_order_id' => 'Merchant Order ID',
            'shipment_id' => 'Shipment ID',
            'shipment_item_id' => 'Shipment Item ID',
            'amazon_order_item_id' => 'Amazon Order Item ID',
            'merchant_order_item_id' => 'Merchant Order Item ID',
            'purchase_date' => 'Purchase Date',
            'payments_date' => 'Payments Date',
            'shipment_date' => 'Shipment Date',
            'reporting_date' => 'Reporting Date',
            'buyer_email' => 'Buyer Email',
            'buyer_name' => 'Buyer Name',
            'buyer_phone_number' => 'Buyer Phone Number',
            'sku' => 'Sku',
            'product_name' => 'Product Name',
            'quantity_shipped' => 'Quantity Shipped',
            'currency' => 'Currency',
            'item_price' => 'Item Price',
            'item_tax' => 'Item Tax',
            'shipping_price' => 'Shipping Price',
            'shipping_tax' => 'Shipping Tax',
            'gift_wrap_price' => 'Gift Wrap Price',
            'gift_wrap_tax' => 'Gift Wrap Tax',
            'ship_service_level' => 'Ship Service Level',
            'recipient_name' => 'Recipient Name',
            'ship_address_1' => 'Ship Address 1',
            'ship_address_2' => 'Ship Address 2',
            'ship_address_3' => 'Ship Address 3',
            'ship_city' => 'Ship City',
            'ship_state' => 'Ship State',
            'ship_postal_code' => 'Ship Postal Code',
            'ship_country' => 'Ship Country',
            'ship_phone_number' => 'Ship Phone Number',
            'bill_address_1' => 'Bill Address 1',
            'bill_address_2' => 'Bill Address 2',
            'bill_address_3' => 'Bill Address 3',
            'bill_city' => 'Bill City',
            'bill_state' => 'Bill State',
            'bill_postal_code' => 'Bill Postal Code',
            'bill_country' => 'Bill Country',
            'item_promotion_discount' => 'Item Promotion Discount',
            'ship_promotion_discount' => 'Ship Promotion Discount',
            'carrier' => 'Carrier',
            'tracking_number' => 'Tracking Number',
            'estimated_arrival_date' => 'Estimated Arrival Date',
            'fulfillment_center_id' => 'Fulfillment Center ID',
            'fulfillment_channel' => 'Fulfillment Channel',
            'sales_channel' => 'Sales Channel',
            'fosdrd_date' => 'Fosdrd Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
