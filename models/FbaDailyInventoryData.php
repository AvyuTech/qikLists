<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_daily_inventory_data".
 *
 * @property int $fdid_id
 * @property string $snapshot_date
 * @property string $fnsku
 * @property string $sku
 * @property string $product_name
 * @property string $quantity
 * @property string $fulfillment_center_id
 * @property string $detailed_disposition
 * @property string $country
 * @property string $fdid_date
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class FbaDailyInventoryData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_daily_inventory_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['snapshot_date', 'fnsku', 'sku', 'product_name', 'quantity', 'fulfillment_center_id', 'detailed_disposition', 'country'], 'string'],
            [['fdid_date'], 'safe'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fdid_id' => 'Fdid ID',
            'snapshot_date' => 'Snapshot Date',
            'fnsku' => 'Fnsku',
            'sku' => 'Sku',
            'product_name' => 'Product Name',
            'quantity' => 'Quantity',
            'fulfillment_center_id' => 'Fulfillment Center ID',
            'detailed_disposition' => 'Detailed Disposition',
            'country' => 'Country',
            'fdid_date' => 'Fdid Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
