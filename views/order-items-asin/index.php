<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderItemsAsinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Items Asins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-items-asin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order Items Asin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'oia_id',
            'oia_order_id',
            'oia_asin',
            'oia_category',
            'oia_referral_fee',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'oia_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
