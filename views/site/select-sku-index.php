<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FbaAllListingDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Select SKU';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("
    $(function(){
        $('.sBtn').click(function(e) {
           var r = confirm('Are you sure to submit this configuration?');
           if(r == true) {
                window.location.replace('".\yii\helpers\Url::to(['/site/repriser', 's' => 'success'])."');
           } else {
                return false;
           }
        });
    });
");
?>
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Select SKU or Upload CSV</h3>
        <div class="box-tools">
            <?= Html::button('Submit', ['class' => 'btn btn-sm btn-primary sBtn']); ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <?= Html::label('Min Price', ['class' => 'control-label']); ?>
                <?= Html::textInput('minPrice', '', ['class' => 'form-control', 'required' => true]); ?>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?= Html::label('Max Price', ['class' => 'control-label']); ?>
                <?= Html::textInput('maxPrice', '', ['class' => 'form-control', 'required' => true]); ?>
            </div>
        </div>
        <hr/>
        <?= Html::label('Select CSV', ['class' => 'control-label']); ?>
        <?= Html::fileInput('csvFile', null, ['class' => 'form-control']); ?>
        <hr/>
        <h3 class="text-center">OR</h3>
        <hr/>
    </div>

    <div class="box-body table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' => function($model) {
                        return ['value' => $model->fald_id, 'class' => 'ac-chk'];
                    },
                ],

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
                /*[
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
                ],*/
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
                 'asin1',
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
    <div class="box-footer">
        <?= Html::button('Submit', ['class' => 'btn btn-sm btn-primary sBtn']); ?>
    </div>
</div>
