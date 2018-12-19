<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_customer_return_data".
 *
 * @property integer $fcrd_id
 * @property string $return_date
 * @property string $order_id
 * @property string $sku
 * @property string $asin
 * @property string $fnsku
 * @property string $product_name
 * @property string $quantity
 * @property string $fulfillment_center_id
 * @property string $detailed_disposition
 * @property string $reason
 * @property string $status
 * @property string $license_plate_number
 * @property string $customer_comments
 * @property string $fcrd_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class FbaCustomerReturnData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_customer_return_data';
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
            [['fcrd_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['return_date', 'order_id', 'sku', 'asin', 'fnsku', 'product_name', 'quantity', 'fulfillment_center_id', 'detailed_disposition', 'reason', 'status', 'license_plate_number', 'customer_comments'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fcrd_id' => 'Fcrd ID',
            'return_date' => 'Return Date',
            'order_id' => 'Order ID',
            'sku' => 'Sku',
            'asin' => 'Asin',
            'fnsku' => 'Fnsku',
            'product_name' => 'Product Name',
            'quantity' => 'Quantity',
            'fulfillment_center_id' => 'Fulfillment Center ID',
            'detailed_disposition' => 'Detailed Disposition',
            'reason' => 'Reason',
            'status' => 'Status',
            'license_plate_number' => 'License Plate Number',
            'customer_comments' => 'Customer Comments',
            'fcrd_date' => 'Fcrd Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getFinancialData()
    {
        return $this->hasOne(FbaFinancialTransaction::className(), ['order_id' => 'order_id']);
    }
}
