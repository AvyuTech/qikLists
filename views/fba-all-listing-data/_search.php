<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbaAllListingDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fba-all-listing-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fald_id') ?>

    <?= $form->field($model, 'item_name') ?>

    <?= $form->field($model, 'item_description') ?>

    <?= $form->field($model, 'listing_id') ?>

    <?= $form->field($model, 'seller_sku') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'open_date') ?>

    <?php // echo $form->field($model, 'image_url') ?>

    <?php // echo $form->field($model, 'item_is_marketplace') ?>

    <?php // echo $form->field($model, 'product_id_type') ?>

    <?php // echo $form->field($model, 'zshop_shipping_fee') ?>

    <?php // echo $form->field($model, 'item_note') ?>

    <?php // echo $form->field($model, 'item_condition') ?>

    <?php // echo $form->field($model, 'zshop_category1') ?>

    <?php // echo $form->field($model, 'zshop_browse_path') ?>

    <?php // echo $form->field($model, 'zshop_storefront_feature') ?>

    <?php // echo $form->field($model, 'asin1') ?>

    <?php // echo $form->field($model, 'asin2') ?>

    <?php // echo $form->field($model, 'asin3') ?>

    <?php // echo $form->field($model, 'will_ship_internationally') ?>

    <?php // echo $form->field($model, 'expedited_shipping') ?>

    <?php // echo $form->field($model, 'zshop_boldface') ?>

    <?php // echo $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'bid_for_featured_placement') ?>

    <?php // echo $form->field($model, 'add_delete') ?>

    <?php // echo $form->field($model, 'pending_quantity') ?>

    <?php // echo $form->field($model, 'fulfillment_channel') ?>

    <?php // echo $form->field($model, 'merchant_shipping_group') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'fald_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
