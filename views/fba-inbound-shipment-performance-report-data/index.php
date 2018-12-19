<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FbaInboundShipmentPerformanceReportDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fba Inbound Shipment Performance Report Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-inbound-shipment-performance-report-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fba Inbound Shipment Performance Report Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fisprd_id',
            'issue_reported_date',
            'shipment_creation_date',
            'fba_shipment_id',
            'fba_carton_id',
            // 'fulfillment_center_id',
            // 'sku',
            // 'fnsku',
            // 'asin',
            // 'product_name',
            // 'problem_type',
            // 'problem_quantity',
            // 'expected_quantity',
            // 'received_quantity',
            // 'performance_measurement_unit',
            // 'fee_type',
            // 'currency',
            // 'fee_total',
            // 'problem_level',
            // 'alert_status',
            // 'fisprd_date',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
