<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FbaInboundShipmentPerformanceReportData */

$this->title = 'Update Fba Inbound Shipment Performance Report Data: ' . $model->fisprd_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba Inbound Shipment Performance Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fisprd_id, 'url' => ['view', 'id' => $model->fisprd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fba-inbound-shipment-performance-report-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
