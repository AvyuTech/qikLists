<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ShipmentRefundEventData */

$this->title = $model->sred_id;
$this->params['breadcrumbs'][] = ['label' => 'Shipment Refund Event Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipment-refund-event-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->sred_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->sred_id], [
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
            'sred_id',
            'sred_amazon_order_id',
            'sred_seller_order_id',
            'sred_marketplace_name',
            'sred_shipment_posted_date',
            'sred_refund_posted_date',
            'sred_seller_sku',
            'sred_order_item_id',
            'sred_order_adjustment_item_id',
            'sred_quantity_shipped',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'sred_status',
        ],
    ]) ?>

</div>
