<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_adjustment_item_list_data".
 *
 * @property integer $oaild_id
 * @property string $oaild_amazon_order_id
 * @property string $oaild_seller_order_id
 * @property integer $oaild_quantity
 * @property string $oaild_per_unit_amount
 * @property string $oaild_total_amount
 * @property string $oaild_currency
 * @property string $oaild_seller_sku
 * @property string $oaild_fnsku
 * @property string $oaild_product_description
 * @property string $oaild_asin
 * @property integer $oaild_shipment_refund_event_data_id
 * @property integer $order_adjustment_event_data_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $oaild_status
 */
class OrderAdjustmentItemListData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_adjustment_item_list_data';
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
            [['oaild_quantity', 'oaild_shipment_refund_event_data_id', 'order_adjustment_event_data_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'oaild_status'], 'integer'],
            [['oaild_per_unit_amount', 'oaild_total_amount'], 'number'],
            [['oaild_product_description'], 'string'],
            [['oaild_amazon_order_id', 'oaild_seller_order_id', 'oaild_seller_sku', 'oaild_fnsku'], 'string', 'max' => 255],
            [['oaild_currency', 'oaild_asin'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oaild_id' => 'Oaild ID',
            'oaild_amazon_order_id' => 'Oaild Amazon Order ID',
            'oaild_seller_order_id' => 'Oaild Seller Order ID',
            'oaild_quantity' => 'Oaild Quantity',
            'oaild_per_unit_amount' => 'Oaild Per Unit Amount',
            'oaild_total_amount' => 'Oaild Total Amount',
            'oaild_currency' => 'Oaild Currency',
            'oaild_seller_sku' => 'Oaild Seller Sku',
            'oaild_fnsku' => 'Oaild Fnsku',
            'oaild_product_description' => 'Oaild Product Description',
            'oaild_asin' => 'Oaild Asin',
            'oaild_shipment_refund_event_data_id' => 'Oaild Shipment Refund Event Data ID',
            'order_adjustment_event_data_id' => 'Order Adjustment Event Data ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'oaild_status' => 'Oaild Status',
        ];
    }
}
