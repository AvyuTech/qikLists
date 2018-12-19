<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_settlement_report_data".
 *
 * @property integer $fsrd_id
 * @property string $settlement_id
 * @property string $settlement_start_date
 * @property string $settlement_end_date
 * @property string $deposit_date
 * @property string $total_amount
 * @property string $currency
 * @property string $transaction_type
 * @property string $order_id
 * @property string $merchant_order_id
 * @property string $adjustment_id
 * @property string $shipment_id
 * @property string $marketplace_name
 * @property string $shipment_fee_type
 * @property string $shipment_fee_amount
 * @property string $order_fee_type
 * @property string $order_fee_amount
 * @property string $fulfillment_id
 * @property string $posted_date
 * @property string $order_item_code
 * @property string $merchant_order_item_id
 * @property string $merchant_adjustment_item_id
 * @property string $sku
 * @property string $quantity_purchased
 * @property string $price_type
 * @property string $price_amount
 * @property string $item_related_fee_type
 * @property string $item_related_fee_amount
 * @property string $misc_fee_amount
 * @property string $other_fee_amount
 * @property string $other_fee_reason_description
 * @property string $promotion_id
 * @property string $promotion_type
 * @property string $promotion_amount
 * @property string $direct_payment_type
 * @property string $direct_payment_amount
 * @property string $other_amount
 * @property string $fsrd_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $fsrd_diff_days
 */
class FbaSettlementReportData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_settlement_report_data';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
            ],
            'blameable' => [
                'class' =>  'yii\behaviors\BlameableBehavior',
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fsrd_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['fsrd_diff_days', 'settlement_id', 'settlement_start_date', 'settlement_end_date', 'deposit_date', 'total_amount', 'currency', 'transaction_type', 'order_id', 'merchant_order_id', 'adjustment_id', 'shipment_id', 'marketplace_name', 'shipment_fee_type', 'shipment_fee_amount', 'order_fee_type', 'order_fee_amount', 'fulfillment_id', 'posted_date', 'order_item_code', 'merchant_order_item_id', 'merchant_adjustment_item_id', 'sku', 'quantity_purchased', 'price_type', 'price_amount', 'item_related_fee_type', 'item_related_fee_amount', 'misc_fee_amount', 'other_fee_amount', 'other_fee_reason_description', 'promotion_id', 'promotion_type', 'promotion_amount', 'direct_payment_type', 'direct_payment_amount', 'other_amount'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fsrd_id' => 'Fsrd ID',
            'fsrd_diff_days' => 'Days Difference',
            'settlement_id' => 'Settlement ID',
            'settlement_start_date' => 'Settlement Start Date',
            'settlement_end_date' => 'Settlement End Date',
            'deposit_date' => 'Deposit Date',
            'total_amount' => 'Total Amount',
            'currency' => 'Currency',
            'transaction_type' => 'Transaction Type',
            'order_id' => 'Order ID',
            'merchant_order_id' => 'Merchant Order ID',
            'adjustment_id' => 'Adjustment ID',
            'shipment_id' => 'Shipment ID',
            'marketplace_name' => 'Marketplace Name',
            'shipment_fee_type' => 'Shipment Fee Type',
            'shipment_fee_amount' => 'Shipment Fee Amount',
            'order_fee_type' => 'Order Fee Type',
            'order_fee_amount' => 'Order Fee Amount',
            'fulfillment_id' => 'Fulfillment ID',
            'posted_date' => 'Posted Date',
            'order_item_code' => 'Order Item Code',
            'merchant_order_item_id' => 'Merchant Order Item ID',
            'merchant_adjustment_item_id' => 'Merchant Adjustment Item ID',
            'sku' => 'Sku',
            'quantity_purchased' => 'Quantity Purchased',
            'price_type' => 'Price Type',
            'price_amount' => 'Price Amount',
            'item_related_fee_type' => 'Item Related Fee Type',
            'item_related_fee_amount' => 'Item Related Fee Amount',
            'misc_fee_amount' => 'Misc Fee Amount',
            'other_fee_amount' => 'Other Fee Amount',
            'other_fee_reason_description' => 'Other Fee Reason Description',
            'promotion_id' => 'Promotion ID',
            'promotion_type' => 'Promotion Type',
            'promotion_amount' => 'Promotion Amount',
            'direct_payment_type' => 'Direct Payment Type',
            'direct_payment_amount' => 'Direct Payment Amount',
            'other_amount' => 'Other Amount',
            'fsrd_date' => 'Fsrd Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
