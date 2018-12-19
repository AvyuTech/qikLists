<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_all_listing_data".
 *
 * @property integer $fald_id
 * @property string $item_name
 * @property string $item_description
 * @property string $listing_id
 * @property string $seller_sku
 * @property string $price
 * @property string $quantity
 * @property string $open_date
 * @property string $image_url
 * @property string $item_is_marketplace
 * @property string $product_id_type
 * @property string $zshop_shipping_fee
 * @property string $item_note
 * @property string $item_condition
 * @property string $zshop_category1
 * @property string $zshop_browse_path
 * @property string $zshop_storefront_feature
 * @property string $asin1
 * @property string $asin2
 * @property string $asin3
 * @property string $will_ship_internationally
 * @property string $expedited_shipping
 * @property string $zshop_boldface
 * @property string $product_id
 * @property string $bid_for_featured_placement
 * @property string $add_delete
 * @property string $pending_quantity
 * @property string $fulfillment_channel
 * @property string $merchant_shipping_group
 * @property string $status
 * @property string $fald_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $buybox_price
 * @property string $buy_cost
 * @property string $repricing_min_price
 * @property string $repricing_max_price
 * @property integer $repricing_rule_id
 * @property string $repricing_cost_price
 * @property string $commission_fees
 * @property string $fba_fees
 */
class FbaAllListingData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_all_listing_data';
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
            [['commission_fees', 'fba_fees', 'fald_date', 'buybox_price', 'buy_cost', 'repricing_min_price', 'repricing_max_price', 'repricing_rule_id', 'repricing_cost_price'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['item_name', 'item_description', 'listing_id', 'seller_sku', 'price', 'quantity', 'open_date', 'image_url', 'item_is_marketplace', 'product_id_type', 'zshop_shipping_fee', 'item_note', 'item_condition', 'zshop_category1', 'zshop_browse_path', 'zshop_storefront_feature', 'asin1', 'asin2', 'asin3', 'will_ship_internationally', 'expedited_shipping', 'zshop_boldface', 'product_id', 'bid_for_featured_placement', 'add_delete', 'pending_quantity', 'fulfillment_channel', 'merchant_shipping_group', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fald_id' => 'Fald ID',
            'item_name' => 'Item Name',
            'buy_cost' => 'Buy Cost',
            'item_description' => 'Item Description',
            'listing_id' => 'Listing ID',
            'seller_sku' => 'Seller Sku',
            'price' => 'Price',
            'buybox_price' => 'BuyBox Price',
            'quantity' => 'Quantity',
            'open_date' => 'Open Date',
            'image_url' => 'Image Url',
            'item_is_marketplace' => 'Item Is Marketplace',
            'product_id_type' => 'Product Id Type',
            'zshop_shipping_fee' => 'Zshop Shipping Fee',
            'item_note' => 'Item Note',
            'item_condition' => 'Item Condition',
            'zshop_category1' => 'Zshop Category1',
            'zshop_browse_path' => 'Zshop Browse Path',
            'zshop_storefront_feature' => 'Zshop Storefront Feature',
            'asin1' => 'ASIN',
            'asin2' => 'Asin2',
            'asin3' => 'Asin3',
            'will_ship_internationally' => 'Will Ship Internationally',
            'expedited_shipping' => 'Expedited Shipping',
            'zshop_boldface' => 'Zshop Boldface',
            'product_id' => 'Product ID',
            'bid_for_featured_placement' => 'Bid For Featured Placement',
            'add_delete' => 'Add Delete',
            'pending_quantity' => 'Pending Quantity',
            'fulfillment_channel' => 'Fulfillment Channel',
            'merchant_shipping_group' => 'Merchant Shipping Group',
            'status' => 'Status',
            'fald_date' => 'Fald Date',
            'repricing_rule_id' => 'Repricing Rule',
            'repricing_max_price' => 'Repricing Max Price',
            'repricing_min_price' => 'Repricing Min Price',
            'repricing_cost_price' => 'Magic Repricing Amount',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getRule()
    {
        return $this->hasOne(RepriserRule::className(), ['rr_id' => 'repricing_rule_id']);
    }

    public function getProductStock()
    {
        return $this->hasOne(FbaDailyInventoryData::className(), ['sku' => 'seller_sku']);
    }

    public function getProductReceived()
    {
        return $this->hasOne(FbaReceivedInventoryData::className(), ['sku' => 'seller_sku']);
    }
}
