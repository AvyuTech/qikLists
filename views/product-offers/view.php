<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProductOffers */

$this->title = $model->po_id;
$this->params['breadcrumbs'][] = ['label' => 'Product Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-offers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->po_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->po_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'po_id',
            'po_condition',
            'po_seller_feedback_rating',
            'po_seller_feedback_count',
            'po_listing_price',
            'po_shipping_cost',
            'po_is_amazon_fulfillment',
            'po_is_buybox_winner',
            'po_is_featured_merchant',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'po_status',
        ],
    ]) ?>

</div>
