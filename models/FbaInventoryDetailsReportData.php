<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_inventory_details_report_data".
 *
 * @property integer $fidrd_id
 * @property string $snapshot_date
 * @property string $transaction_type
 * @property string $fnsku
 * @property string $sku
 * @property string $product_name
 * @property string $fulfillment_center_id
 * @property string $quantity
 * @property string $disposition
 * @property string $fidrd_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class FbaInventoryDetailsReportData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_inventory_details_report_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fidrd_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['snapshot_date', 'transaction_type', 'fnsku', 'sku', 'product_name', 'fulfillment_center_id', 'quantity', 'disposition'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fidrd_id' => 'Fidrd ID',
            'snapshot_date' => 'Snapshot Date',
            'transaction_type' => 'Transaction Type',
            'fnsku' => 'Fnsku',
            'sku' => 'Sku',
            'product_name' => 'Product Name',
            'fulfillment_center_id' => 'Fulfillment Center ID',
            'quantity' => 'Quantity',
            'disposition' => 'Disposition',
            'fidrd_date' => 'Fidrd Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
