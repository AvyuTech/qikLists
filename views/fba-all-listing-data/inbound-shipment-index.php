<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FbaAllListingDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inbound Shipment Concessions';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-default">
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-bordered'],
            'rowOptions' => function($model, $index, $widget, $grid) {
                $checkData = \app\models\FbaReceivedInventoryData::find()->where(['sku' => $model->seller_sku])->exists();
                if($checkData) {
                    return ['class' => 'bg-success'];
                } else {
                    $checkReimbData = \app\models\ReimbursementsReport::find()->where(['sku' => $model->seller_sku])->exists();
                    if($checkReimbData) {
                        return ['class' => 'bg-success'];
                    }
                }
                return ['class' => 'bg-danger'];
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'item_name',
                //'item_description',
                'listing_id',
                'seller_sku',
                'price',
                //'quantity',
                'open_date',
                // 'image_url:url',
                'item_is_marketplace',
                'product_id_type',
                //'zshop_shipping_fee',
                //'item_note',
                'item_condition',
                //'zshop_category1',
                // 'zshop_browse_path',
                // 'zshop_storefront_feature',
                'asin1',
                // 'asin2',
                // 'asin3',
                //'will_ship_internationally',
                //'expedited_shipping',
                // 'zshop_boldface',
                'product_id',
                // 'bid_for_featured_placement',
                //'add_delete',
                //'pending_quantity',
                'fulfillment_channel',
                'merchant_shipping_group',
                'status',
                // 'fald_date',
                // 'created_by',
                // 'updated_by',
                // 'created_at',
                // 'updated_at',

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>