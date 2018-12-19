<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_removal_order_detail_report_data".
 *
 * @property integer $frodrd_id
 * @property string $request_date
 * @property string $order_id
 * @property string $order_type
 * @property string $order_status
 * @property string $last_updated_date
 * @property string $sku
 * @property string $fnsku
 * @property string $disposition
 * @property string $requested_quantity
 * @property string $cancelled_quantity
 * @property string $disposed_quantity
 * @property string $shipped_quantity
 * @property string $in_process_quantity
 * @property string $removal_fee
 * @property string $currency
 * @property string $frodrd_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class FbaRemovalOrderDetailReportData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_removal_order_detail_report_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frodrd_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['request_date', 'order_id', 'order_type', 'order_status', 'last_updated_date', 'sku', 'fnsku', 'disposition', 'requested_quantity', 'cancelled_quantity', 'disposed_quantity', 'shipped_quantity', 'in_process_quantity', 'removal_fee', 'currency'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'frodrd_id' => 'Frodrd ID',
            'request_date' => 'Request Date',
            'order_id' => 'Order ID',
            'order_type' => 'Order Type',
            'order_status' => 'Order Status',
            'last_updated_date' => 'Last Updated Date',
            'sku' => 'Sku',
            'fnsku' => 'Fnsku',
            'disposition' => 'Disposition',
            'requested_quantity' => 'Requested Quantity',
            'cancelled_quantity' => 'Cancelled Quantity',
            'disposed_quantity' => 'Disposed Quantity',
            'shipped_quantity' => 'Shipped Quantity',
            'in_process_quantity' => 'In Process Quantity',
            'removal_fee' => 'Removal Fee',
            'currency' => 'Currency',
            'frodrd_date' => 'Frodrd Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
