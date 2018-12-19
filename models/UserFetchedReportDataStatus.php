<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_fetched_report_data_status".
 *
 * @property integer $ufrds_id
 * @property integer $ufrds_reimbursement_report
 * @property integer $ufrds_return_report
 * @property integer $ufrds_inventory_adjustment_report
 * @property integer $ufrds_all_listing_report
 * @property integer $ufrds_received_inventory_report
 * @property integer $ufrds_restock_report
 * @property integer $ufrds_all_order_report
 * @property string $ufrds_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $ufrds_user_id
 * @property integer $ufrds_status
 */
class UserFetchedReportDataStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_fetched_report_data_status';
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
            [['ufrds_reimbursement_report', 'ufrds_return_report', 'ufrds_inventory_adjustment_report', 'ufrds_all_listing_report', 'ufrds_received_inventory_report', 'ufrds_restock_report', 'ufrds_all_order_report', 'created_by', 'updated_by', 'created_at', 'updated_at', 'ufrds_user_id', 'ufrds_status'], 'integer'],
            [['ufrds_date'], 'safe'],
            [['ufrds_user_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ufrds_id' => 'Ufrds ID',
            'ufrds_reimbursement_report' => 'Reimbursement Report',
            'ufrds_return_report' => 'Return Report',
            'ufrds_inventory_adjustment_report' => 'Inventory Adjustment Report',
            'ufrds_all_listing_report' => 'All Listing Report',
            'ufrds_received_inventory_report' => 'Received Inventory Report',
            'ufrds_restock_report' => 'Restock Report',
            'ufrds_all_order_report' => 'All Order Report',
            'ufrds_date' => 'Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'ufrds_user_id' => 'User',
            'ufrds_status' => 'Status',
        ];
    }
}
