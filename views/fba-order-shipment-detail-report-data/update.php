<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FbaOrderShipmentDetailReportData */

$this->title = 'Update Fba Order Shipment Detail Report Data: ' . $model->fosdrd_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba Order Shipment Detail Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fosdrd_id, 'url' => ['view', 'id' => $model->fosdrd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fba-order-shipment-detail-report-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
