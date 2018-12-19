<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderAdjustmentItemListDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Adjustment Item List Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-adjustment-item-list-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order Adjustment Item List Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'oaild_id',
            'oaild_amazon_order_id',
            'oaild_seller_order_id',
            'oaild_quantity',
            'oaild_per_unit_amount',
            // 'oaild_total_amount',
            // 'oaild_currency',
            // 'oaild_seller_sku',
            // 'oaild_fnsku',
            // 'oaild_product_description:ntext',
            // 'oaild_asin',
            // 'oaild_shipment_refund_event_data_id',
            // 'order_adjustment_event_data_id',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'oaild_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
