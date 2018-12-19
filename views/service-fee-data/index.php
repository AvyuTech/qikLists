<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceFeeDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Fee Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-fee-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Service Fee Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sfd_id',
            'sfd_amazon_order_id',
            'sfd_seller_order_id',
            'sfd_fee_reason',
            'sfd_fee_type',
            // 'sfd_fee_amount',
            // 'sfd_currency',
            // 'sfd_seller_sku',
            // 'sfd_fnsku',
            // 'sfd_fee_description:ntext',
            // 'sfd_asin',
            // 'sfd_shipment_refund_event_data_id',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',
            // 'sfd_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
