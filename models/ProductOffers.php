<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_offers".
 *
 * @property integer $po_id
 * @property string $po_condition
 * @property string $po_seller_feedback_rating
 * @property integer $po_seller_feedback_count
 * @property string $po_listing_price
 * @property string $po_shipping_cost
 * @property integer $po_is_amazon_fulfillment
 * @property integer $po_is_buybox_winner
 * @property integer $po_is_featured_merchant
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $po_status
 * @property string $po_asin
 */
class ProductOffers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_offers';
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
            [['po_seller_feedback_rating', 'po_listing_price', 'po_shipping_cost'], 'number'],
            [['po_asin', 'po_seller_feedback_count', 'po_is_amazon_fulfillment', 'po_is_buybox_winner', 'po_is_featured_merchant', 'created_at', 'updated_at', 'created_by', 'updated_by', 'po_status'], 'integer'],
            [['po_condition'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'po_id' => 'Po ID',
            'po_condition' => 'Condition',
            'po_asin' => 'ASIN',
            'po_seller_feedback_rating' => 'Seller Feedback Rating',
            'po_seller_feedback_count' => 'Seller Feedback Count',
            'po_listing_price' => 'Listing Price',
            'po_shipping_cost' => 'Shipping Cost',
            'po_is_amazon_fulfillment' => 'Is Amazon Fulfillment',
            'po_is_buybox_winner' => 'Is Buybox Winner',
            'po_is_featured_merchant' => 'Is Featured Merchant',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'po_status' => 'Po Status',
        ];
    }
}
