<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FbaAllListingData */

$this->title = $model->fald_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba All Listing Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-all-listing-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fald_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fald_id], [
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
            'fald_id',
            'item_name',
            'item_description',
            'listing_id',
            'seller_sku',
            'price',
            'quantity',
            'open_date',
            'image_url:url',
            'item_is_marketplace',
            'product_id_type',
            'zshop_shipping_fee',
            'item_note',
            'item_condition',
            'zshop_category1',
            'zshop_browse_path',
            'zshop_storefront_feature',
            'asin1',
            'asin2',
            'asin3',
            'will_ship_internationally',
            'expedited_shipping',
            'zshop_boldface',
            'product_id',
            'bid_for_featured_placement',
            'add_delete',
            'pending_quantity',
            'fulfillment_channel',
            'merchant_shipping_group',
            'status',
            'fald_date',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
