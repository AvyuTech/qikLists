<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FbaOrderShipmentDetailReportData */

$this->title = 'Create Fba Order Shipment Detail Report Data';
$this->params['breadcrumbs'][] = ['label' => 'Fba Order Shipment Detail Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-order-shipment-detail-report-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
