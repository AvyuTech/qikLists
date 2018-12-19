<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ShipmentRefundEventData */

$this->title = 'Update Shipment Refund Event Data: ' . $model->sred_id;
$this->params['breadcrumbs'][] = ['label' => 'Shipment Refund Event Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sred_id, 'url' => ['view', 'id' => $model->sred_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shipment-refund-event-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
