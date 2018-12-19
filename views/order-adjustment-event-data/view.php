<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderAdjustmentEventData */

$this->title = $model->oaed_id;
$this->params['breadcrumbs'][] = ['label' => 'Order Adjustment Event Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-adjustment-event-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->oaed_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->oaed_id], [
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
            'oaed_id',
            'oaed_amazon_order_id',
            'oaed_seller_order_id',
            'oaed_adjustment_type',
            'oaed_amount',
            'oaed_currency',
            'oaed_shipment_refund_event_data_id',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'oaed_status',
        ],
    ]) ?>

</div>
