<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_received_inventory_data".
 *
 * @property integer $frid_id
 * @property string $received_date
 * @property string $fnsku
 * @property string $sku
 * @property string $product_name
 * @property string $quantity
 * @property string $fba_shipment_id
 * @property string $fulfillment_center_id
 * @property string $frid_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class FbaReceivedInventoryData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_received_inventory_data';
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
            [['frid_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['received_date', 'fnsku', 'sku', 'product_name', 'quantity', 'fba_shipment_id', 'fulfillment_center_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'frid_id' => 'Frid ID',
            'received_date' => 'Received Date',
            'fnsku' => 'Fnsku',
            'sku' => 'Sku',
            'product_name' => 'Product Name',
            'quantity' => 'Quantity',
            'fba_shipment_id' => 'Fba Shipment ID',
            'fulfillment_center_id' => 'Fulfillment Center ID',
            'frid_date' => 'Frid Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
