<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductOffersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Offers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-offers-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product Offers', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'po_id',
            'po_condition',
            'po_seller_feedback_rating',
            'po_seller_feedback_count',
            'po_listing_price',
            // 'po_shipping_cost',
            // 'po_is_amazon_fulfillment',
            // 'po_is_buybox_winner',
            // 'po_is_featured_merchant',
            // 'created_at',
            // 'updated_at',
            // 'created_by',
            // 'updated_by',
            // 'po_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
