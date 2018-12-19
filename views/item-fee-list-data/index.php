<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemFeeListDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Fee List Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-fee-list-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Fee List Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ifld_id',
            'ifld_amazon_order_id',
            'ifld_seller_order_id',
            'ifld_fee_type',
            'ifld_fee_amount',
            // 'ifld_currency',
            // 'ifld_transaction_type',
            // 'ifld_item_type',
            // 'ifld_shipment_refund_event_id',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',
            // 'ifld_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
