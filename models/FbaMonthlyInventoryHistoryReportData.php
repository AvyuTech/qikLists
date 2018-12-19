<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_monthly_inventory_history_report_data".
 *
 * @property integer $fmihrd_id
 * @property string $month
 * @property string $fnsku
 * @property string $sku
 * @property string $product_name
 * @property string $average_quantity
 * @property string $end_quantity
 * @property string $fulfillment_center_id
 * @property string $detailed_disposition
 * @property string $country
 * @property string $fmihrd_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class FbaMonthlyInventoryHistoryReportData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_monthly_inventory_history_report_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fmihrd_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['month', 'fnsku', 'sku', 'product_name', 'average_quantity', 'end_quantity', 'fulfillment_center_id', 'detailed_disposition', 'country'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fmihrd_id' => 'Fmihrd ID',
            'month' => 'Month',
            'fnsku' => 'Fnsku',
            'sku' => 'Sku',
            'product_name' => 'Product Name',
            'average_quantity' => 'Average Quantity',
            'end_quantity' => 'End Quantity',
            'fulfillment_center_id' => 'Fulfillment Center ID',
            'detailed_disposition' => 'Detailed Disposition',
            'country' => 'Country',
            'fmihrd_date' => 'Fmihrd Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
