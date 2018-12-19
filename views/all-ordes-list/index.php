<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AllOrdesListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Ordes Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'aol_amazon_order_id:ntext',
                //'aol_seller_order_id:ntext',
                'aol_purchase_date',
                'aol_last_updated_date:ntext',
                'aol_order_status:ntext',
                // 'aol_fulfilment_channel:ntext',
                // 'aol_sales_channel:ntext',
                // 'aol_ship_service:ntext',
                'aol_order_total',
                'aol_shipped_items',
                'aol_unshipped_items',
                // 'created_at',
                // 'updated_at',
                // 'aol_status',
            ],
        ]); ?>
    </div>
</div>
