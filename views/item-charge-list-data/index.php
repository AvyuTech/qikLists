<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemChargeListDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Charge List Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-charge-list-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Charge List Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'icld_id',
            'icld_amazon_order_id',
            'icld_seller_order_id',
            'icld_item_charge_type',
            'icld_charge_amount',
            // 'icld_currency',
            // 'icld_shipment_refund_event_data_id',
            // 'icld_transaction_type',
            // 'icld_item_type',
            // 'updated_at',
            // 'created_at',
            // 'created_by',
            // 'updated_by',
            // 'icld_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
