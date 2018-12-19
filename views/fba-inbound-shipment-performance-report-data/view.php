<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FbaInboundShipmentPerformanceReportData */

$this->title = $model->fisprd_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba Inbound Shipment Performance Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-inbound-shipment-performance-report-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fisprd_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fisprd_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fisprd_id',
            'issue_reported_date',
            'shipment_creation_date',
            'fba_shipment_id',
            'fba_carton_id',
            'fulfillment_center_id',
            'sku',
            'fnsku',
            'asin',
            'product_name',
            'problem_type',
            'problem_quantity',
            'expected_quantity',
            'received_quantity',
            'performance_measurement_unit',
            'fee_type',
            'currency',
            'fee_total',
            'problem_level',
            'alert_status',
            'fisprd_date',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
