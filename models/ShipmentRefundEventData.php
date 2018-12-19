<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shipment_refund_event_data".
 *
 * @property integer $sred_id
 * @property string $sred_amazon_order_id
 * @property string $sred_seller_order_id
 * @property string $sred_marketplace_name
 * @property string $sred_shipment_posted_date
 * @property string $sred_refund_posted_date
 * @property string $sred_seller_sku
 * @property string $sred_order_item_id
 * @property string $sred_order_adjustment_item_id
 * @property integer $sred_quantity_shipped
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $sred_status
 * @property string $sred_event_type
 * @property integer $sred_day_diff
 */
class ShipmentRefundEventData extends \yii\db\ActiveRecord
{
    public $itemStatus, $startDate, $endDate;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_refund_event_data';
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
            [['sred_day_diff', 'sred_quantity_shipped', 'created_at', 'updated_at', 'created_by', 'updated_by', 'sred_status'], 'integer'],
            [['sred_price_diff', 'sred_event_type', 'sred_amazon_order_id', 'sred_seller_order_id', 'sred_marketplace_name', 'sred_shipment_posted_date', 'sred_refund_posted_date', 'sred_seller_sku', 'sred_order_item_id', 'sred_order_adjustment_item_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sred_id' => 'Sred ID',
            'itemStatus' => 'Status',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
            'sred_amazon_order_id' => 'Amazon Order ID',
            'sred_seller_order_id' => 'Seller Order ID',
            'sred_marketplace_name' => 'Marketplace Name',
            'sred_shipment_posted_date' => 'Shipment Posted Date',
            'sred_refund_posted_date' => 'Refund Posted Date',
            'sred_seller_sku' => 'Seller Sku',
            'sred_order_item_id' => 'Order Item ID',
            'sred_order_adjustment_item_id' => 'Order Adjustment Item ID',
            'sred_quantity_shipped' => 'Quantity Shipped',
            'sred_day_diff' => 'Days Different',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'sred_price_diff' => 'Amount Difference',
            'sred_status' => 'Sred Status',
        ];
    }

    public function getReimbursement()
    {
        return $this->hasOne(ReimbursementsReport::className(), ['amazon_order_id' => 'sred_amazon_order_id']);
    }

    public function getOrder()
    {
        return $this->hasOne(AllOrdesList::className(), ['aol_amazon_order_id' => 'sred_amazon_order_id']);
    }

    public function getOrderCharges()
    {
        return $this->hasOne(ItemChargeListData::className(), ['icld_amazon_order_id' => 'sred_amazon_order_id']);
    }

    public function getOrderFees()
    {
        return $this->hasOne(ItemFeeListData::className(), ['ifld_amazon_order_id'=> 'sred_amazon_order_id']);
    }
}
