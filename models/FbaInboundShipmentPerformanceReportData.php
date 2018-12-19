<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fba_inbound_shipment_performance_report_data".
 *
 * @property integer $fisprd_id
 * @property string $issue_reported_date
 * @property string $shipment_creation_date
 * @property string $fba_shipment_id
 * @property string $fba_carton_id
 * @property string $fulfillment_center_id
 * @property string $sku
 * @property string $fnsku
 * @property string $asin
 * @property string $product_name
 * @property string $problem_type
 * @property string $problem_quantity
 * @property string $expected_quantity
 * @property string $received_quantity
 * @property string $performance_measurement_unit
 * @property string $fee_type
 * @property string $currency
 * @property string $fee_total
 * @property string $problem_level
 * @property string $alert_status
 * @property string $fisprd_date
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class FbaInboundShipmentPerformanceReportData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fba_inbound_shipment_performance_report_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fisprd_date'], 'safe'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['issue_reported_date', 'shipment_creation_date', 'fba_shipment_id', 'fba_carton_id', 'fulfillment_center_id', 'sku', 'fnsku', 'asin', 'product_name', 'problem_type', 'problem_quantity', 'expected_quantity', 'received_quantity', 'performance_measurement_unit', 'fee_type', 'currency', 'fee_total', 'problem_level', 'alert_status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fisprd_id' => 'Fisprd ID',
            'issue_reported_date' => 'Issue Reported Date',
            'shipment_creation_date' => 'Shipment Creation Date',
            'fba_shipment_id' => 'Fba Shipment ID',
            'fba_carton_id' => 'Fba Carton ID',
            'fulfillment_center_id' => 'Fulfillment Center ID',
            'sku' => 'Sku',
            'fnsku' => 'Fnsku',
            'asin' => 'Asin',
            'product_name' => 'Product Name',
            'problem_type' => 'Problem Type',
            'problem_quantity' => 'Problem Quantity',
            'expected_quantity' => 'Expected Quantity',
            'received_quantity' => 'Received Quantity',
            'performance_measurement_unit' => 'Performance Measurement Unit',
            'fee_type' => 'Fee Type',
            'currency' => 'Currency',
            'fee_total' => 'Fee Total',
            'problem_level' => 'Problem Level',
            'alert_status' => 'Alert Status',
            'fisprd_date' => 'Fisprd Date',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
