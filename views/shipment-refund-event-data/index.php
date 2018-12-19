<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ShipmentRefundEventDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shipment Refund Event Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipment-refund-event-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Shipment Refund Event Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sred_id',
            'sred_amazon_order_id',
            'sred_seller_order_id',
            'sred_marketplace_name',
            'sred_shipment_posted_date',
            // 'sred_refund_posted_date',
            // 'sred_seller_sku',
            // 'sred_order_item_id',
            // 'sred_order_adjustment_item_id',
            // 'sred_quantity_shipped',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'sred_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
