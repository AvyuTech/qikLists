<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reimbursements_report".
 *
 * @property integer $rr_id
 * @property string $approval_date
 * @property string $reimbursement_id
 * @property string $case_id
 * @property string $amazon_order_id
 * @property string $reason
 * @property string $sku
 * @property string $fnsku
 * @property string $asin
 * @property string $product_name
 * @property string $condition
 * @property string $currency_unit
 * @property string $amount_per_unit
 * @property string $amount_total
 * @property string $quantity_reimbursed_cash
 * @property string $quantity_reimbursed_inventory
 * @property string $quantity_reimbursed_total
 * @property string $original_reimbursement_id
 * @property string $original_reimbursement_type
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $rr_date
 */
class ReimbursementsReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reimbursements_report';
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
            [['rr_date', 'approval_date', 'reimbursement_id', 'case_id', 'amazon_order_id', 'reason', 'sku', 'fnsku', 'asin', 'product_name', 'condition', 'currency_unit', 'amount_per_unit', 'amount_total', 'quantity_reimbursed_cash', 'quantity_reimbursed_inventory', 'quantity_reimbursed_total', 'original_reimbursement_id', 'original_reimbursement_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rr_id' => 'Rr ID',
            'approval_date' => 'Approval Date',
            'reimbursement_id' => 'Reimbursement ID',
            'case_id' => 'Case ID',
            'amazon_order_id' => 'Amazon Order ID',
            'reason' => 'Reason',
            'sku' => 'Sku',
            'rr_date' => 'Date',
            'fnsku' => 'Fnsku',
            'asin' => 'Asin',
            'product_name' => 'Product Name',
            'condition' => 'Condition',
            'currency_unit' => 'Currency Unit',
            'amount_per_unit' => 'Amount Per Unit',
            'amount_total' => 'Amount Total',
            'quantity_reimbursed_cash' => 'Quantity Reimbursed Cash',
            'quantity_reimbursed_inventory' => 'Quantity Reimbursed Inventory',
            'quantity_reimbursed_total' => 'Quantity Reimbursed Total',
            'original_reimbursement_id' => 'Original Reimbursement ID',
            'original_reimbursement_type' => 'Original Reimbursement Type',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
