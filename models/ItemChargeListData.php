<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_charge_list_data".
 *
 * @property integer $icld_id
 * @property string $icld_amazon_order_id
 * @property string $icld_seller_order_id
 * @property string $icld_item_charge_type
 * @property string $icld_charge_amount
 * @property string $icld_currency
 * @property integer $icld_shipment_refund_event_data_id
 * @property string $icld_transaction_type
 * @property string $icld_item_type
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $icld_status
 * @property string $icld_seller_sku
 * @property string $icld_order_item_id
 * @property string $icld_order_adjustment_item_id
 * @property string $icld_quantity_shipped
 * @property string $icld_shipment_date
 * @property string $icld_refund_date
 */
class ItemChargeListData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_charge_list_data';
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
            [['icld_charge_amount'], 'number'],
            [['icld_shipment_refund_event_data_id', 'updated_at', 'created_at', 'created_by', 'updated_by', 'icld_status'], 'integer'],
            [['icld_refund_date', 'icld_shipment_date',  'icld_order_item_id', 'icld_order_adjustment_item_id', 'icld_seller_sku', 'icld_quantity_shipped', 'icld_amazon_order_id', 'icld_seller_order_id', 'icld_item_charge_type', 'icld_currency', 'icld_transaction_type', 'icld_item_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'icld_id' => 'Icld ID',
            'icld_amazon_order_id' => 'Icld Amazon Order ID',
            'icld_seller_order_id' => 'Icld Seller Order ID',
            'icld_item_charge_type' => 'Icld Item Charge Type',
            'icld_charge_amount' => 'Icld Charge Amount',
            'icld_currency' => 'Icld Currency',
            '$icld_shipment_date' => 'Shipment Date',
            'icld_refund_date' => 'Refund Date',
            'icld_shipment_refund_event_data_id' => 'Icld Shipment Refund Event Data ID',
            'icld_transaction_type' => 'Icld Transaction Type',
            'icld_item_type' => 'Icld Item Type',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'icld_status' => 'Icld Status',
        ];
    }
}
