<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FbaOrderShipmentDetailReportData */

$this->title = $model->fosdrd_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba Order Shipment Detail Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-order-shipment-detail-report-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fosdrd_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fosdrd_id], [
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
            'fosdrd_id',
            'amazon_order_id',
            'merchant_order_id',
            'shipment_id',
            'shipment_item_id',
            'amazon_order_item_id',
            'merchant_order_item_id',
            'purchase_date',
            'payments_date',
            'shipment_date',
            'reporting_date',
            'buyer_email:email',
            'buyer_name',
            'buyer_phone_number',
            'sku',
            'product_name',
            'quantity_shipped',
            'currency',
            'item_price',
            'item_tax',
            'shipping_price',
            'shipping_tax',
            'gift_wrap_price',
            'gift_wrap_tax',
            'ship_service_level',
            'recipient_name',
            'ship_address_1',
            'ship_address_2',
            'ship_address_3',
            'ship_city',
            'ship_state',
            'ship_postal_code',
            'ship_country',
            'ship_phone_number',
            'bill_address_1',
            'bill_address_2',
            'bill_address_3',
            'bill_city',
            'bill_state',
            'bill_postal_code',
            'bill_country',
            'item_promotion_discount',
            'ship_promotion_discount',
            'carrier',
            'tracking_number',
            'estimated_arrival_date',
            'fulfillment_center_id',
            'fulfillment_channel',
            'sales_channel',
            'fosdrd_date',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
