<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_financial_transaction".
 *
 * @property integer $fft_id
 * @property string $date_time
 * @property string $settlement_id
 * @property string $type
 * @property string $order_id
 * @property string $sku
 * @property string $description
 * @property string $quantity
 * @property string $marketplace
 * @property string $fulfillment
 * @property string $order_city
 * @property string $order_state
 * @property string $order_postal
 * @property string $product_sales
 * @property string $shipping_credits
 * @property string $gift_wrap_credits
 * @property string $promotional_rebates
 * @property string $sales_tax_collected
 * @property string $Marketplace_Facilitator_Tax
 * @property string $selling_fees
 * @property string $fba_fees
 * @property string $other_transaction_fees
 * @property string $other
 * @property string $total
 * @property string $fft_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $fft_diff_days
 */
class FbaFinancialTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_financial_transaction';
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
            [['fft_date'], 'safe'],
            [['fft_diff_days', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['date_time', 'settlement_id', 'type', 'order_id', 'sku', 'description', 'quantity', 'marketplace', 'fulfillment', 'order_city', 'order_state', 'order_postal', 'product_sales', 'shipping_credits', 'gift_wrap_credits', 'promotional_rebates', 'sales_tax_collected', 'Marketplace_Facilitator_Tax', 'selling_fees', 'fba_fees', 'other_transaction_fees', 'other', 'total'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fft_id' => 'Fft ID',
            'date_time' => 'Date Time',
            'settlement_id' => 'Settlement ID',
            'type' => 'Type',
            'order_id' => 'Order ID',
            'sku' => 'Sku',
            'fft_diff_days' => 'Days Difference',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'marketplace' => 'Marketplace',
            'fulfillment' => 'Fulfillment',
            'order_city' => 'Order City',
            'order_state' => 'Order State',
            'order_postal' => 'Order Postal',
            'product_sales' => 'Product Sales',
            'shipping_credits' => 'Shipping Credits',
            'gift_wrap_credits' => 'Gift Wrap Credits',
            'promotional_rebates' => 'Promotional Rebates',
            'sales_tax_collected' => 'Sales Tax Collected',
            'Marketplace_Facilitator_Tax' => 'Marketplace  Facilitator  Tax',
            'selling_fees' => 'Selling Fees',
            'fba_fees' => 'Fba Fees',
            'other_transaction_fees' => 'Other Transaction Fees',
            'other' => 'Other',
            'total' => 'Total',
            'fft_date' => 'Fft Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
