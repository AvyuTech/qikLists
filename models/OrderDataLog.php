<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_data_log".
 *
 * @property integer $odl_id
 * @property integer $odl_user_id
 * @property string $odl_order_id
 * @property integer $odl_shipment_data
 * @property integer $odl_refund_data
 * @property integer $odl_service_fee_data
 * @property integer $odl_adjustment_data
 * @property integer $odl_shipped_order_data
 * @property integer $odl_all_asin_data
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $odl_status
 */
class OrderDataLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_data_log';
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
            [['odl_user_id'], 'required'],
            [['odl_user_id', 'odl_shipment_data', 'odl_refund_data', 'odl_service_fee_data', 'odl_adjustment_data', 'odl_shipped_order_data', 'odl_all_asin_data', 'created_at', 'updated_at', 'created_by', 'updated_by', 'odl_status'], 'integer'],
            [['odl_order_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'odl_id' => 'Odl ID',
            'odl_user_id' => 'User',
            'odl_order_id' => 'Order',
            'odl_shipment_data' => 'Shipment Data',
            'odl_refund_data' => 'Refund Data',
            'odl_service_fee_data' => 'Service Fee Data',
            'odl_adjustment_data' => 'Adjustment Data',
            'odl_shipped_order_data' => 'Shipped Order Data',
            'odl_all_asin_data' => 'All ASIN Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'odl_status' => 'Status',
        ];
    }
}
