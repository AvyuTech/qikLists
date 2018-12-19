<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "va_notification".
 *
 * @property integer $vn_id
 * @property integer $vn_va_id
 * @property integer $vn_seller_id
 * @property integer $vn_shipment_refund_event_data_id
 * @property string $vn_amazon_order_id
 * @property string $vn_refund_posted_date
 * @property integer $vn_is_seen
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $vn_status
 */
class VaNotification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'va_notification';
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
            [['vn_va_id', 'vn_seller_id', 'vn_shipment_refund_event_data_id', 'vn_is_seen', 'created_at', 'updated_at', 'created_by', 'updated_by', 'vn_status'], 'integer'],
            [['vn_amazon_order_id'], 'string', 'max' => 200],
            [['vn_refund_posted_date'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vn_id' => 'Vn ID',
            'vn_va_id' => 'VA',
            'vn_seller_id' => 'Seller',
            'vn_shipment_refund_event_data_id' => 'Shipment Refund Event Data ID',
            'vn_amazon_order_id' => 'Amazon Order ID',
            'vn_refund_posted_date' => 'Refund Posted Date',
            'vn_is_seen' => 'Is Seen',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'vn_status' => 'Vn Status',
        ];
    }
}
