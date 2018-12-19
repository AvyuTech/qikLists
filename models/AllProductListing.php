<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "all_product_listing".
 *
 * @property integer $apl_id
 * @property string $sku
 * @property string $fnsku
 * @property string $asin
 * @property string $product_name
 * @property string $condition
 * @property string $your_price
 * @property string $mfn_listing_exists
 * @property string $mfn_fulfillable_quantity
 * @property string $afn_listing_exists
 * @property string $afn_warehouse_quantity
 * @property string $afn_fulfillable_quantity
 * @property string $afn_unsellable_quantity
 * @property string $afn_reserved_quantity
 * @property string $afn_total_quantity
 * @property string $per_unit_volume
 * @property string $afn_inbound_working_quantity
 * @property string $afn_inbound_shipped_quantity
 * @property string $afn_inbound_receiving_quantity
 * @property string $apl_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class AllProductListing extends \yii\db\ActiveRecord
{
    public $pCount;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'all_product_listing';
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
            [['apl_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['sku', 'fnsku', 'asin', 'product_name', 'condition', 'your_price', 'mfn_listing_exists', 'mfn_fulfillable_quantity', 'afn_listing_exists', 'afn_warehouse_quantity', 'afn_fulfillable_quantity', 'afn_unsellable_quantity', 'afn_reserved_quantity', 'afn_total_quantity', 'per_unit_volume', 'afn_inbound_working_quantity', 'afn_inbound_shipped_quantity', 'afn_inbound_receiving_quantity'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'apl_id' => 'Apl ID',
            'sku' => 'Sku',
            'fnsku' => 'Fnsku',
            'asin' => 'Asin',
            'product_name' => 'Product Name',
            'condition' => 'Condition',
            'your_price' => 'Your Price',
            'mfn_listing_exists' => 'Mfn Listing Exists',
            'mfn_fulfillable_quantity' => 'Mfn Fulfillable Quantity',
            'afn_listing_exists' => 'Afn Listing Exists',
            'afn_warehouse_quantity' => 'Afn Warehouse Quantity',
            'afn_fulfillable_quantity' => 'Afn Fulfillable Quantity',
            'afn_unsellable_quantity' => 'Afn Unsellable Quantity',
            'afn_reserved_quantity' => 'Afn Reserved Quantity',
            'afn_total_quantity' => 'Afn Total Quantity',
            'per_unit_volume' => 'Per Unit Volume',
            'afn_inbound_working_quantity' => 'Afn Inbound Working Quantity',
            'afn_inbound_shipped_quantity' => 'Afn Inbound Shipped Quantity',
            'afn_inbound_receiving_quantity' => 'Afn Inbound Receiving Quantity',
            'apl_date' => 'Apl Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getProductPrice()
    {
        return $this->hasOne(AdjustmentInventoryReport::className(), ['fnsku' => 'fnsku']);
    }
}
