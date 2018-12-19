<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VaNotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">All Unread Notifications</h3>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'vn_amazon_order_id',
                'vn_refund_posted_date',
                'vn_seller_id',

               // ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>

<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">All Notifications</h3>
    </div>
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProviderA,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'vn_amazon_order_id',
                'vn_refund_posted_date',
                'vn_seller_id',

                // ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>