<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_fee_data".
 *
 * @property integer $sfd_id
 * @property string $sfd_amazon_order_id
 * @property string $sfd_seller_order_id
 * @property string $sfd_fee_reason
 * @property string $sfd_fee_type
 * @property string $sfd_fee_amount
 * @property string $sfd_currency
 * @property string $sfd_seller_sku
 * @property string $sfd_fnsku
 * @property string $sfd_fee_description
 * @property string $sfd_asin
 * @property integer $sfd_shipment_refund_event_data_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sfd_status
 */
class ServiceFeeData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_fee_data';
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
            [['sfd_fee_amount'], 'number'],
            [['sfd_fee_description'], 'string'],
            [['sfd_shipment_refund_event_data_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'sfd_status'], 'integer'],
            [['sfd_amazon_order_id', 'sfd_seller_order_id', 'sfd_fee_reason', 'sfd_fee_type', 'sfd_currency', 'sfd_seller_sku', 'sfd_fnsku'], 'string', 'max' => 255],
            [['sfd_asin'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sfd_id' => 'Sfd ID',
            'sfd_amazon_order_id' => 'Sfd Amazon Order ID',
            'sfd_seller_order_id' => 'Sfd Seller Order ID',
            'sfd_fee_reason' => 'Sfd Fee Reason',
            'sfd_fee_type' => 'Sfd Fee Type',
            'sfd_fee_amount' => 'Sfd Fee Amount',
            'sfd_currency' => 'Sfd Currency',
            'sfd_seller_sku' => 'Sfd Seller Sku',
            'sfd_fnsku' => 'Sfd Fnsku',
            'sfd_fee_description' => 'Sfd Fee Description',
            'sfd_asin' => 'Sfd Asin',
            'sfd_shipment_refund_event_data_id' => 'Sfd Shipment Refund Event Data ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'sfd_status' => 'Sfd Status',
        ];
    }
}
