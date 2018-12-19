<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ShipmentRefundEventData */

$this->title = 'Create Shipment Refund Event Data';
$this->params['breadcrumbs'][] = ['label' => 'Shipment Refund Event Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipment-refund-event-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
