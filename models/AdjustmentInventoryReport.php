<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adjustment_inventory_report".
 *
 * @property integer $air_id
 * @property string $adjusted_date
 * @property string $transaction_item_id
 * @property string $fnsku
 * @property string $sku
 * @property string $product_name
 * @property string $fulfillment_center_id
 * @property string $quantity
 * @property string $reason
 * @property string $disposition
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $air_date
 */
class AdjustmentInventoryReport extends \yii\db\ActiveRecord
{
    public $itemStatus, $startDate, $endDate;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adjustment_inventory_report';
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
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['air_date', 'adjusted_date', 'transaction_item_id', 'fnsku', 'sku', 'product_name', 'fulfillment_center_id', 'quantity', 'reason', 'disposition'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'air_id' => 'Air ID',
            'adjusted_date' => 'Adjusted Date',
            'transaction_item_id' => 'Transaction Item ID',
            'fnsku' => 'Fnsku',
            'sku' => 'Sku',
            'air_date' => 'Date',
            'product_name' => 'Product Name',
            'fulfillment_center_id' => 'Fulfillment Center ID',
            'quantity' => 'Quantity',
            'reason' => 'Reason',
            'disposition' => 'Disposition',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'itemStatus' => 'Status',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
        ];
    }

    public static function getReasonType($type=null, $html=true)
    {
        $data = [
            'E' => ($html) ? '<span class="label label-primary">Damaged</span>' : 'Damaged',
            'D' => ($html) ? '<span class="label label-danger">Destroyed</span>' : 'Destroyed',
            'M' => ($html) ? '<span class="label label-warning">Lost</span>' : 'Lost',
            'Q' => ($html) ? '<span class="label bg-purple">Damaged (miscellaneous)</span>' : 'Damaged (miscellaneous)',
            'F' => ($html) ? '<span class="label bg-blue">Inventory Found</span>' : 'Inventory Found',
            'H' => ($html) ? '<span class="label bg-light-blue">Damaged (Customer Return)</span>' : 'Damaged (Customer Return)',
            'J' => ($html) ? '<span class="label bg-teal">Software Correction</span>' : 'Software Correction',
            'K' => ($html) ? '<span class="label bg-orange">Damaged (Item Defect)</span>' : 'Damaged (Item Defect)',
            'N' => ($html) ? '<span class="label bg-black">Transfer From Holding Account</span>' : 'Transfer From Holding Account',
            'O' => ($html) ? '<span class="label bg-gray">Transfer To Holding Account</span>' : 'Transfer To Holding Account',
            'P' => ($html) ? '<span class="label bg-maroon">Unsellable</span>' : 'Unsellable',
            'U' => ($html) ? '<span class="label bg-aqua">Damaged by Merchant</span>' : 'Damaged by Merchant',
            1 => ($html) ? '<span class="label bg-teal">Software Correction (+)</span>' : 'Software Correction (+)',
            2 => ($html) ? '<span class="label bg-teal">Software Correction (-)</span>' : 'Software Correction (-)',
            3 => ($html) ? '<span class="label bg-black-active">Product Redefined & Transfer In</span>' : 'Product Redefined & Transfer In',
            4 => ($html) ? '<span class="label bg-gray-active">Product Redefined & Transfer Out</span>' : 'Product Redefined & Transfer Out',
            5 => ($html) ? '<span class="label bg-maroon-active">Unrecoverable Inventory</span>' : 'Unrecoverable Inventory',
            6 => ($html) ? '<span class="label bg-aqua-active">Damaged by Inbound Carrier</span>' : 'Damaged by Inbound Carrier',
            7 => ($html) ? '<span class="label bg-orange-active">Damaged to Expired Unit</span>' : 'Damaged to Expired Unit',
        ];

        if($type && key_exists($type, $data)) {
            return $data[$type];
        } elseif(empty($type)) {
            return [
                'E' => 'Damaged',
                'D' => 'Destroyed',
                'M' => 'Lost',
                'Q' => 'Damaged (miscellaneous)',
                'F' => 'Inventory Found',
                'H' => 'Damaged (Customer Return)',
                'J' => 'Software Correction',
                'K' => 'Damaged (Item Defect)',
                'N' => 'Transfer From Holding Account',
                'O' => 'Transfer To Holding Account',
                'P' => 'Unsellable',
                'U' => 'Damaged by Merchant',
                1 => 'Software Correction (+)',
                2 => 'Software Correction (-)',
                3 => 'Product Redefined & Transfer In',
                4 => 'Product Redefined & Transfer Out',
                5 => 'Unrecoverable Inventory',
                6 => 'Damaged by Inbound Carrier',
                7 => 'Damaged to Expired Unit',
            ];
        }

        return ($html) ? "<span class='label label-info'>".$type."</span>" : $type;
    }

    public function getReSku()
    {
        return $this->hasOne(ReimbursementsReport::className(), ['reimbursements_report.sku' => 'sku']);
    }

    public function getProductPrice()
    {
        return $this->hasOne(AllProductListing::className(), ['fnsku' => 'fnsku']);
    }
}
