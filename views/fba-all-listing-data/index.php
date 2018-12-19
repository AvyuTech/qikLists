<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FbaAllListingDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Active Listing';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default">
    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'image_url',
                    'value' => function($model) {
                        return ($model->image_url) ? Html::img($model->image_url) : null;
                    },
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-center'],
                    'filter' => false,
                ],
                'item_name',
                'seller_sku',
                [
                    'attribute' => 'price',
                    'value' => function($model) {
                        return ($model->price) ? round($model->price, 2) : null;
                    }
                ],
                [
                    'attribute' => 'buybox_price',
                    'value' => function($model) {
                        return ($model->buybox_price) ? round($model->buybox_price, 2) : null;
                    }
                ],
                'asin1',
                [
                    'attribute' => 'repricing_min_price',
                    'value' => function($model) {
                        return ($model->repricing_min_price) ? round($model->repricing_min_price, 2) : null;
                    }
                ],
                [
                    'attribute' => 'repricing_max_price',
                    'value' => function($model) {
                        return ($model->repricing_max_price) ? round($model->repricing_max_price, 2) : null;
                    }
                ],
                [
                    'attribute' => 'repricing_rule_id',
                    'value' => function($model) {
                        return ($model->rule) ? $model->rule->rr_name : null;
                    },
                    'filter' => \yii\helpers\ArrayHelper::map(\app\models\RepriserRule::find()->all(), 'rr_id', 'rr_name'),
                ],
                [
                    'attribute' => 'repricing_cost_price',
                    'value' => function($model) {
                        return ($model->repricing_cost_price) ? round($model->repricing_cost_price, 2) : null;
                    }
                ],
                [
                    'header' => 'Action',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{remove-rule}',
                    'buttons' => [
                        'remove-rule' => function($url, $model) {
                            return ($model->repricing_rule_id) ? Html::a('<i class="fa fa-remove"></i>', ['remove-rule', 'sku' => $model->seller_sku], ['data-confirm' => 'Are sure to remove Repricing Rule for this item?', 'class' => 'text-red', 'title' => 'Remove Rule']) : Html::a('<i class="fa fa-plus-circle"></i>', ['/site/magic-repricing', 'sku' => $model->seller_sku], ['class' => 'text-green', 'title' => 'Add Rule']);
                        }
                    ],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                // 'quantity',
                // 'open_date',
                // 'image_url:url',
                // 'item_is_marketplace',
                // 'product_id_type',
                // 'zshop_shipping_fee',
                // 'item_note',
                // 'item_condition',
                // 'zshop_category1',
                // 'zshop_browse_path',
                // 'zshop_storefront_feature',
                // 'asin2',
                // 'asin3',
                // 'will_ship_internationally',
                // 'expedited_shipping',
                // 'zshop_boldface',
                // 'product_id',
                // 'bid_for_featured_placement',
                // 'add_delete',
                // 'pending_quantity',
                // 'fulfillment_channel',
                // 'merchant_shipping_group',
                // 'status',
                // 'fald_date',
                // 'created_by',
                // 'updated_by',
                // 'created_at',
                // 'updated_at',
            ],
        ]); ?>
    </div>
</div>
