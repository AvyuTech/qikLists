<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderDataLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Data Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-data-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order Data Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'odl_id',
            'odl_user_id',
            'odl_order_id',
            'odl_shipment_data',
            'odl_refund_data',
            // 'odl_service_fee_data',
            // 'odl_adjustment_data',
            // 'odl_shipped_order_data',
            // 'odl_all_asin_data',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'odl_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
