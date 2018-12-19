<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_items_asin".
 *
 * @property integer $oia_id
 * @property string $oia_order_id
 * @property string $oia_asin
 * @property string $oia_category
 * @property string $oia_referral_fee
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $oia_status
 * @property string $oia_item_height
 * @property string $oia_item_width
 * @property string $oia_item_length
 * @property string $oia_item_weight
 * @property  string $oia_package_height
 * @property string $oia_package_width
 * @property string $oia_package_length
 * @property string $oia_package_weight
 */
class OrderItemsAsin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items_asin';
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
            [['oia_order_id', 'oia_asin'], 'required'],
            [['oia_referral_fee'], 'number'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'oia_status'], 'integer'],
            [['oia_order_id'], 'string', 'max' => 255],
            [['oia_asin', 'oia_purchase_date'], 'string', 'max' => 100],
            [['oia_category'], 'string', 'max' => 200],
            [['oia_item_height', 'oia_item_width', 'oia_item_length', 'oia_item_weight', 'oia_package_height', 'oia_package_width', 'oia_package_length', 'oia_package_weight'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oia_id' => 'Oia ID',
            'oia_order_id' => 'Order ID',
            'oia_asin' => 'ASIN',
            'oia_category' => 'Category',
            'oia_referral_fee' => 'Referral Fee',
            'oia_purchase_date' => 'Purchase Date',
            'oia_item_height' => 'Item Height',
            'oia_item_width' => 'Item Width',
            'oia_item_length' => 'Item Length',
            'oia_item_weight' => 'Item Weight',
            'oia_package_height' => 'Package Height',
            'oia_package_width' => 'Package Width',
            'oia_package_length' => 'Package Length',
            'oia_package_weight' => 'Package Weight',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'oia_status' => 'Oia Status',
        ];
    }

    public function getEstimatedFee()
    {
        $height = $this->oia_item_height;
        $length = $this->oia_item_length;
        $width = $this->oia_item_width;
        $weight = $this->oia_item_weight;
        $eFee = 0;

        if($height && $length && $width && $height)
            $eFee = Yii::$app->data->getProductSizeTiers($length, $width, $height, $weight);

        return $eFee;
    }

    public function getSku()
    {
        return $this->hasOne(FbaAllListingData::className(),['asin1' => 'oia_asin']);
    }
}
