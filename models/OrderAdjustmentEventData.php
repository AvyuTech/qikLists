<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_adjustment_event_data".
 *
 * @property integer $oaed_id
 * @property string $oaed_amazon_order_id
 * @property string $oaed_seller_order_id
 * @property string $oaed_adjustment_type
 * @property string $oaed_amount
 * @property string $oaed_currency
 * @property integer $oaed_shipment_refund_event_data_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $oaed_status
 */
class OrderAdjustmentEventData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_adjustment_event_data';
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
            [['oaed_amount'], 'number'],
            [['oaed_shipment_refund_event_data_id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'oaed_status'], 'integer'],
            [['oaed_amazon_order_id', 'oaed_seller_order_id', 'oaed_adjustment_type', 'oaed_currency'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oaed_id' => 'Oaed ID',
            'oaed_amazon_order_id' => 'Oaed Amazon Order ID',
            'oaed_seller_order_id' => 'Oaed Seller Order ID',
            'oaed_adjustment_type' => 'Oaed Adjustment Type',
            'oaed_amount' => 'Oaed Amount',
            'oaed_currency' => 'Oaed Currency',
            'oaed_shipment_refund_event_data_id' => 'Oaed Shipment Refund Event Data ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'oaed_status' => 'Oaed Status',
        ];
    }
}
