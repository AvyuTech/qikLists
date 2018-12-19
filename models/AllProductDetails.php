<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "all_product_details".
 *
 * @property integer $apd_id
 * @property string $apd_asin
 * @property string $apd_binding
 * @property string $apd_brand
 * @property string $apd_color
 * @property string $apd_department
 * @property string $apd_item_height
 * @property string $apd_item_width
 * @property string $apd_item_length
 * @property string $apd_item_weight
 * @property string $apd_label
 * @property string $apd_size
 * @property string $apd_package_height
 * @property string $apd_package_width
 * @property string $apd_package_length
 * @property string $apd_package_weight
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $apd_status
 * @property string $apd_refferal_fee
 * @property string $apd_category
 */
class AllProductDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'all_product_details';
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
            [['apd_item_height', 'apd_item_width', 'apd_item_length', 'apd_item_weight', 'apd_package_height', 'apd_package_width', 'apd_package_length', 'apd_package_weight'], 'number'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'apd_status'], 'integer'],
            [['apd_asin', 'apd_binding', 'apd_brand', 'apd_color', 'apd_department', 'apd_size'], 'string', 'max' => 200],
            [['apd_label'], 'string', 'max' => 255],
            [['apd_refferal_fee'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'apd_id' => 'ID',
            'apd_asin' => 'ASIN',
            'apd_binding' => 'Binding',
            'apd_brand' => 'Brand',
            'apd_color' => 'Color',
            'apd_department' => 'Department',
            'apd_item_height' => 'Item Height',
            'apd_item_width' => 'Item Width',
            'apd_item_length' => 'Item Length',
            'apd_item_weight' => 'Item Weight',
            'apd_label' => 'Label',
            'apd_size' => 'Size',
            'apd_refferal_fee' => 'Referral Fee',
            'apd_package_height' => 'Package Height',
            'apd_package_width' => 'Package Width',
            'apd_package_length' => 'Package Length',
            'apd_package_weight' => 'Package Weight',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'apd_status' => 'Status',
        ];
    }
}
