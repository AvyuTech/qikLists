<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderAdjustmentEventDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Adjustment Event Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-adjustment-event-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order Adjustment Event Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'oaed_id',
            'oaed_amazon_order_id',
            'oaed_seller_order_id',
            'oaed_adjustment_type',
            'oaed_amount',
            // 'oaed_currency',
            // 'oaed_shipment_refund_event_data_id',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'oaed_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
