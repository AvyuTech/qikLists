<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_restock_data".
 *
 * @property integer $frd_id
 * @property string $Product_Description
 * @property string $SKU
 * @property string $ASIN
 * @property string $Condition
 * @property string $Supplier
 * @property string $Price
 * @property string $Sales_last_30_days_sales
 * @property string $Sales_last_30_days_units
 * @property string $Total_Inventory
 * @property string $Inbound_Inventory
 * @property string $Available_Inventory
 * @property string $Reserved_FC_transfer
 * @property string $Reserved_FC_processing
 * @property string $Reserved_Customer_Order
 * @property string $Unfulfillable
 * @property string $Fulfilled_by
 * @property string $Days_of_Supply
 * @property string $Instock_Alert
 * @property string $Recommended_Order_Quantity
 * @property string $Recommended_Order_Date
 * @property string $frd_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class FbaRestockData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_restock_data';
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
            [['frd_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['Product_Description', 'SKU', 'ASIN', 'Condition', 'Supplier', 'Price', 'Sales_last_30_days_sales', 'Sales_last_30_days_units', 'Total_Inventory', 'Inbound_Inventory', 'Available_Inventory', 'Reserved_FC_transfer', 'Reserved_FC_processing', 'Reserved_Customer_Order', 'Unfulfillable', 'Fulfilled_by', 'Days_of_Supply', 'Instock_Alert', 'Recommended_Order_Quantity', 'Recommended_Order_Date'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'frd_id' => 'Frd ID',
            'Product_Description' => 'Product  Description',
            'SKU' => 'Sku',
            'ASIN' => 'Asin',
            'Condition' => 'Condition',
            'Supplier' => 'Supplier',
            'Price' => 'Price',
            'Sales_last_30_days_sales' => 'Sales Last 30 Days Sales',
            'Sales_last_30_days_units' => 'Sales Last 30 Days Units',
            'Total_Inventory' => 'Total  Inventory',
            'Inbound_Inventory' => 'Inbound  Inventory',
            'Available_Inventory' => 'Available  Inventory',
            'Reserved_FC_transfer' => 'Reserved  Fc Transfer',
            'Reserved_FC_processing' => 'Reserved  Fc Processing',
            'Reserved_Customer_Order' => 'Reserved  Customer  Order',
            'Unfulfillable' => 'Unfulfillable',
            'Fulfilled_by' => 'Fulfilled By',
            'Days_of_Supply' => 'Days Of  Supply',
            'Instock_Alert' => 'Instock  Alert',
            'Recommended_Order_Quantity' => 'Recommended  Order  Quantity',
            'Recommended_Order_Date' => 'Recommended  Order  Date',
            'frd_date' => 'Frd Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
