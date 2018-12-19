<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_stranded_inventory_report_data".
 *
 * @property integer $fsird_id
 * @property string $primary_action
 * @property string $date_stranded
 * @property string $date_classified_as_unsellable
 * @property string $status_primary
 * @property string $status_secondary
 * @property string $error_message
 * @property string $asin
 * @property string $sku
 * @property string $fnsku
 * @property string $product_name
 * @property string $condition
 * @property string $fulfilled_by
 * @property string $fulfillable_qty
 * @property string $your_price
 * @property string $unfulfillable_qty
 * @property string $reserved_quantity
 * @property string $inbound_shipped_qty
 * @property string $fsird_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class FbaStrandedInventoryReportData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_stranded_inventory_report_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fsird_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['primary_action', 'date_stranded', 'date_classified_as_unsellable', 'status_primary', 'status_secondary', 'error_message', 'asin', 'sku', 'fnsku', 'product_name', 'condition', 'fulfilled_by', 'fulfillable_qty', 'your_price', 'unfulfillable_qty', 'reserved_quantity', 'inbound_shipped_qty'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fsird_id' => 'Fsird ID',
            'primary_action' => 'Primary Action',
            'date_stranded' => 'Date Stranded',
            'date_classified_as_unsellable' => 'Date Classified As Unsellable',
            'status_primary' => 'Status Primary',
            'status_secondary' => 'Status Secondary',
            'error_message' => 'Error Message',
            'asin' => 'Asin',
            'sku' => 'Sku',
            'fnsku' => 'Fnsku',
            'product_name' => 'Product Name',
            'condition' => 'Condition',
            'fulfilled_by' => 'Fulfilled By',
            'fulfillable_qty' => 'Fulfillable Qty',
            'your_price' => 'Your Price',
            'unfulfillable_qty' => 'Unfulfillable Qty',
            'reserved_quantity' => 'Reserved Quantity',
            'inbound_shipped_qty' => 'Inbound Shipped Qty',
            'fsird_date' => 'Fsird Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
