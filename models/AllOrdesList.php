<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "all_ordes_list".
 *
 * @property integer $aol_id
 * @property string $aol_amazon_order_id
 * @property string $aol_seller_order_id
 * @property integer $aol_purchase_date
 * @property string $aol_last_updated_date
 * @property string $aol_order_status
 * @property string $aol_fulfilment_channel
 * @property string $aol_sales_channel
 * @property string $aol_ship_service
 * @property string $aol_shipping_username
 * @property string $aol_shipping_address_1
 * @property string $aol_shipping_address_2
 * @property string $aol_shipping_address_3
 * @property string $aol_city
 * @property string $aol_country
 * @property string $aol_district
 * @property string $aol_state_or_region
 * @property string $aol_postal_code
 * @property string $aol_country_code
 * @property string $aol_phone
 * @property string $aol_buyer_name
 * @property string $aol_buyer_email
 * @property string $aol_order_total
 * @property integer $aol_shipped_items
 * @property integer $aol_unshipped_items
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $aol_shipped_status
 * @property integer $aol_status
 * @property string $aol_asin
 */
class AllOrdesList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'all_ordes_list';
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
            /*'blameable' => [
                'class' =>  'yii\behaviors\BlameableBehavior',
            ],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aol_asin', 'aol_purchase_date', 'aol_amazon_order_id', 'aol_seller_order_id', 'aol_last_updated_date', 'aol_order_status', 'aol_fulfilment_channel', 'aol_sales_channel', 'aol_ship_service'], 'string'],
            [['aol_shipped_items', 'aol_unshipped_items', 'created_at', 'updated_at', 'aol_status', 'aol_shipped_status'], 'integer'],
            [['aol_order_total'], 'number'],
            [['aol_shipping_username', 'aol_shipping_address_1', 'aol_shipping_address_2', 'aol_shipping_address_3', 'aol_city', 'aol_country', 'aol_district', 'aol_state_or_region', 'aol_postal_code', 'aol_country_code', 'aol_phone', 'aol_buyer_name', 'aol_buyer_email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aol_id' => 'Aol ID',
            'aol_amazon_order_id' => 'Amazon Order ID',
            'aol_seller_order_id' => 'Seller Order ID',
            'aol_asin' => 'ASIN',
            'aol_purchase_date' => 'Purchase Date',
            'aol_last_updated_date' => 'Aol Last Updated Date',
            'aol_order_status' => 'Order Status',
            'aol_fulfilment_channel' => 'Fulfilment Channel',
            'aol_sales_channel' => 'Sales Channel',
            'aol_ship_service' => 'Aol Ship Service',
            'aol_order_total' => 'Order Total',
            'aol_shipped_items' => 'Shipped Items',
            'aol_unshipped_items' => 'Aol Unshipped Items',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'aol_status' => 'Aol Status',
        ];
    }

    public function getOrderCharges()
    {
        return $this->hasOne(ItemChargeListData::className(), ['icld_amazon_order_id' => 'aol_amazon_order_id']);
    }

    public function getOrderFees()
    {
        return $this->hasOne(ItemFeeListData::className(), ['ifld_amazon_order_id' => 'aol_amazon_order_id']);
    }
}
