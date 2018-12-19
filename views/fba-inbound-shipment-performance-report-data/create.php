<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FbaInboundShipmentPerformanceReportData */

$this->title = 'Create Fba Inbound Shipment Performance Report Data';
$this->params['breadcrumbs'][] = ['label' => 'Fba Inbound Shipment Performance Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-inbound-shipment-performance-report-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
