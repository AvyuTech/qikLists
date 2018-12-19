<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "requested_report".
 *
 * @property integer $rr_id
 * @property string $rr_report_request_id
 * @property string $rr_report_type
 * @property string $rr_start_date
 * @property string $rr_end_date
 * @property string $rr_scheduled
 * @property string $rr_submitted_date
 * @property string $rr_report_processing_status
 * @property string $rr_report_current_status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $rr_status
 * @property string $rr_report_id
 */
class RequestedReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'requested_report';
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
            [['rr_report_request_id', 'rr_report_type', 'rr_scheduled', 'rr_submitted_date', 'rr_report_processing_status'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'rr_status'], 'integer'],
            [['rr_report_request_id', 'rr_report_type', 'rr_report_id'], 'string', 'max' => 200],
            [['rr_start_date', 'rr_end_date'], 'default', 'value' => null],
            [['rr_start_date', 'rr_end_date', 'rr_scheduled', 'rr_submitted_date', 'rr_report_processing_status', 'rr_report_current_status'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rr_id' => 'Rr ID',
            'rr_report_request_id' => 'Report Request ID',
            'rr_report_type' => 'Report Type',
            'rr_start_date' => 'Start Date',
            'rr_end_date' => 'End Date',
            'rr_scheduled' => 'Scheduled',
            'rr_report_id' => 'Report ID',
            'rr_submitted_date' => 'Submitted Date',
            'rr_report_processing_status' => 'Report Processing Status',
            'rr_report_current_status' => 'Report Current Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'rr_status' => 'Rr Status',
        ];
    }

    /**
     * get report type list
     * @return array
     */
    public static function getReportTypeList()
    {
        $data = [
            [
                'type' => '_GET_FLAT_FILE_OPEN_LISTINGS_DATA_',
                'name' => 'Open Listings Report (Text File)',
                'group' => 'Listings Reports',
            ],
            [
                'type' => '_GET_MERCHANT_LISTINGS_DATA_',
                'name' => 'Merchant Active Listings Report',
                'group' => 'Listings Reports',
            ],
            [
                'type' => '_GET_MERCHANT_LISTINGS_ALL_DATA_',
                'name' => 'Merchant All Listings Report',
                'group' => 'Listings Reports',
            ],
            [
                'type' => '_GET_MERCHANT_CANCELLED_LISTINGS_DATA_',
                'name' => 'Canceled Listings Report',
                'group' => 'Listings Reports',
            ],
            [
                'type' => '_GET_CONVERGED_FLAT_FILE_SOLD_LISTINGS_DATA_',
                'name' => 'Sold Listings Report',
                'group' => 'Listings Reports',
            ],
            [
                'type' => '_GET_MERCHANT_LISTINGS_DEFECT_DATA_',
                'name' => 'Quality Listing Report',
                'group' => 'Listings Reports',
            ],
            [
                'type' => '_GET_FLAT_FILE_ACTIONABLE_ORDER_DATA_',
                'name' => 'Unshipped Orders Report',
                'group' => 'Order Reports',
            ],
            [
                'type' => '_GET_FLAT_FILE_ORDERS_DATA_',
                'name' => 'Requested Flat File Order Report',
                'group' => 'Order Reports',
            ],
            [
                'type' => '_GET_CONVERGED_FLAT_FILE_ORDER_REPORT_DATA_',
                'name' => 'Flat File Order Report',
                'group' => 'Order Reports',
            ],
            [
                'type' => '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_LAST_UPDATE_',
                'name' => 'All Orders Report by Last Update',
                'group' => 'Order Reports',
            ],
            [
                'type' => '_GET_FLAT_FILE_ALL_ORDERS_DATA_BY_ORDER_DATE_',
                'name' => 'All Orders Report by Order Date',
                'group' => 'Order Reports',
            ],
            [
                'type' => '_GET_FBA_FULFILLMENT_REMOVAL_ORDER_DETAIL_DATA_',
                'name' => 'FBA Removal Order Detail Report',
                'group' => 'FBA Removals Reports',
            ],
            [
                'type' => '_GET_AMAZON_FULFILLED_SHIPMENTS_DATA_',
                'name' => 'FBA Fulfilled Shipments Report (Order List)',
                'group' => 'FBA Sales Reports',
            ],
            [
                'type' => '_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_SALES_DATA_',
                'name' => 'FBA Customer Shipment Sales Report',
                'group' => 'FBA Sales Reports',
            ],
            [
                'type' => '_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_PROMOTION_DATA_',
                'name' => 'FBA Promotions Report',
                'group' => 'FBA Sales Reports',
            ],
            [
                'type' => '_GET_AFN_INVENTORY_DATA_',
                'name' => 'FBA Amazon Fulfilled Inventory Report',
                'group' => 'FBA Inventory Reports',
            ],
            [
                'type' => '_GET_FBA_FULFILLMENT_INVENTORY_RECEIPTS_DATA_',
                'name' => 'FBA Received Inventory Report',
                'group' => 'FBA Inventory Reports',
            ],
            [
                'type' => '_GET_FBA_FULFILLMENT_MONTHLY_INVENTORY_DATA_',
                'name' => 'FBA Monthly Inventory History Report',
                'group' => 'FBA Inventory Reports',
            ],
            [
                'type' => '_GET_FBA_FULFILLMENT_INVENTORY_HEALTH_DATA_',
                'name' => 'FBA Inventory Health Report',
                'group' => 'FBA Inventory Reports',
            ],
            [
                'type' => '_GET_RESTOCK_INVENTORY_RECOMMENDATIONS_REPORT_',
                'name' => 'Restock Inventory Report',
                'group' => 'FBA Inventory Reports',
            ],
            [
                'type' => '_GET_FBA_FULFILLMENT_INBOUND_NONCOMPLIANCE_DATA_',
                'name' => 'FBA Inbound Performance Report',
                'group' => 'FBA Inventory Reports',
            ],
            [
                'type' => '_GET_FBA_MYI_UNSUPPRESSED_INVENTORY_DATA_',
                'name' => 'FBA Manage Inventory',
                'group' => 'FBA Inventory Reports',
            ],
            /*[
                'type' => '_GET_FBA_FULFILLMENT_INBOUND_NONCOMPLIANCE_DATA_',
                'name' => 'FBA Inbound Compliance Report',
                'group' => 'FBA Inventory Reports',
            ],*/
            [
                'type' => '_GET_FBA_FULFILLMENT_INVENTORY_ADJUSTMENTS_DATA_',
                'name' => 'FBA Inventory Adjustments Report',
                'group' => 'FBA Inventory Reports',
            ],
            [
                'type' => '_GET_STRANDED_INVENTORY_UI_DATA_',
                'name' => 'FBA Stranded Inventory Report',
                'group' => 'FBA Inventory Reports',
            ],
            [
                'type' => '_GET_FBA_FULFILLMENT_INVENTORY_SUMMARY_DATA_',
                'name' => 'FBA Inventory Event Detail Report',
                'group' => 'FBA Inventory Reports',
            ],
            [
                'type' => '_GET_FBA_ESTIMATED_FBA_FEES_TXT_DATA_',
                'name' => 'FBA Fee Preview Report',
                'group' => 'FBA Payments Reports',
            ],
			[
                'type' => '_GET_DATE_RANGE_FINANCIAL_TRANSACTION_DATA_',
                'name' => 'FBA Date Range Financial Transaction Report',
                'group' => 'FBA Payments Reports',
            ],
			/*[
                'type' => '_GET_V2_SETTLEMENT_REPORT_DATA_FLAT_FILE_',
                'name' => 'FBA Settlement Report',
                'group' => 'FBA Payments Reports',
            ],*/
            [
                'type' => '_GET_FBA_REIMBURSEMENTS_DATA_',
                'name' => 'FBA Reimbursements Report',
                'group' => 'FBA Payments Reports',
            ],
            [
                'type' => '_GET_FBA_FULFILLMENT_CUSTOMER_RETURNS_DATA_',
                'name' => 'FBA Returns Report',
                'group' => 'FBA Customer Concessions Reports',
            ],
            [
                'type' => '_GET_FBA_FULFILLMENT_CUSTOMER_SHIPMENT_REPLACEMENT_DATA_',
                'name' => 'FBA Replacements Report',
                'group' => 'FBA Customer Concessions Reports',
            ],
            [
                'type' => '_GET_SELLER_FEEDBACK_DATA_',
                'name' => 'Seller Feedback Report',
                'group' => 'Performance Reports',
            ],
            [
                'type' => '_GET_V1_SELLER_PERFORMANCE_REPORT_',
                'name' => 'Seller Performance Report',
                'group' => 'Performance Reports',
            ]
        ];


        return $data;
    }

    /**
     * Get report type data for dropdownlist
     * @return array
     */
    public static function getReportTypesData()
    {
        $data = self::getReportTypeList();

        return ArrayHelper::map($data, 'type', 'name', 'group');
    }

    /**
     * get report type name
     * @param $type
     * @return null
     */
    public function getReportTypeName($type) {

        $reportTypeList = self::getReportTypeList();
        foreach ($reportTypeList as $key => $val) {
            if ($val['type'] == $type) {
                return $val['name'];
            }
        }
        return null;
    }

    /**
     * get requested report status
     * @param null $type
     * @return array|mixed
     */
    public static function getRRStatusType($type=null, $html=true)
    {
        if($html) {
            $data = [
                '_SUBMITTED_' => '<span class="label label-info">Submitted</span>',
                '_IN_PROGRESS_' => '<span class="label label-warning">In Progress</span>',
                '_CANCELLED_' => '<span class="label label-danger">Cancelled</span>',
                '_DONE_' => '<span class="label label-success">Done</span>',
                '_DONE_NO_DATA_' => '<span class="label label-success">Done (No Data Found)</span>'
            ];
        } else {
            $data = [
                '_SUBMITTED_' => 'Submitted',
                '_IN_PROGRESS_' => 'In Progress',
                '_CANCELLED_' => 'Cancelled',
                '_DONE_' => 'Done',
                '_DONE_NO_DATA_' => 'Done (No Data Found)'
            ];
        }

        if($type) {
            return $data[$type];
        } else {
            return $data;
        }
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['u_id' => 'created_by']);
    }
}
