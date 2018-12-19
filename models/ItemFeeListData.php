<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_fee_list_data".
 *
 * @property integer $ifld_id
 * @property string $ifld_amazon_order_id
 * @property string $ifld_seller_order_id
 * @property string $ifld_fee_type
 * @property string $ifld_fee_amount
 * @property string $ifld_currency
 * @property string $ifld_transaction_type
 * @property string $ifld_item_type
 * @property integer $ifld_shipment_refund_event_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $ifld_status
 * @property string $ifld_seller_sku
 * @property string $ifld_order_item_id
 * @property string $ifld_order_adjustment_item_id
 * @property string $ifld_quantity_shipped
 */
class ItemFeeListData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_fee_list_data';
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
            [['ifld_fee_amount'], 'number'],
            [['ifld_shipment_refund_event_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'ifld_status'], 'integer'],
            [['ifld_order_adjustment_item_id', 'ifld_order_item_id', 'ifld_seller_sku', 'ifld_quantity_shipped', 'ifld_amazon_order_id', 'ifld_seller_order_id', 'ifld_fee_type', 'ifld_currency', 'ifld_transaction_type', 'ifld_item_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ifld_id' => 'Ifld ID',
            'ifld_amazon_order_id' => 'Ifld Amazon Order ID',
            'ifld_seller_order_id' => 'Ifld Seller Order ID',
            'ifld_fee_type' => 'Ifld Fee Type',
            'ifld_fee_amount' => 'Ifld Fee Amount',
            'ifld_currency' => 'Ifld Currency',
            'ifld_transaction_type' => 'Ifld Transaction Type',
            'ifld_item_type' => 'Ifld Item Type',
            'ifld_shipment_refund_event_id' => 'Ifld Shipment Refund Event ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ifld_status' => 'Ifld Status',
        ];
    }
}
