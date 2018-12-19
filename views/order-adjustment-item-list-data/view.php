<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderAdjustmentItemListData */

$this->title = $model->oaild_id;
$this->params['breadcrumbs'][] = ['label' => 'Order Adjustment Item List Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-adjustment-item-list-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->oaild_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->oaild_id], [
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
            'oaild_id',
            'oaild_amazon_order_id',
            'oaild_seller_order_id',
            'oaild_quantity',
            'oaild_per_unit_amount',
            'oaild_total_amount',
            'oaild_currency',
            'oaild_seller_sku',
            'oaild_fnsku',
            'oaild_product_description:ntext',
            'oaild_asin',
            'oaild_shipment_refund_event_data_id',
            'order_adjustment_event_data_id',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'oaild_status',
        ],
    ]) ?>

</div>
