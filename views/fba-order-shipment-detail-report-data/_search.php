<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbaOrderShipmentDetailReportDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fba-order-shipment-detail-report-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fosdrd_id') ?>

    <?= $form->field($model, 'amazon_order_id') ?>

    <?= $form->field($model, 'merchant_order_id') ?>

    <?= $form->field($model, 'shipment_id') ?>

    <?= $form->field($model, 'shipment_item_id') ?>

    <?php // echo $form->field($model, 'amazon_order_item_id') ?>

    <?php // echo $form->field($model, 'merchant_order_item_id') ?>

    <?php // echo $form->field($model, 'purchase_date') ?>

    <?php // echo $form->field($model, 'payments_date') ?>

    <?php // echo $form->field($model, 'shipment_date') ?>

    <?php // echo $form->field($model, 'reporting_date') ?>

    <?php // echo $form->field($model, 'buyer_email') ?>

    <?php // echo $form->field($model, 'buyer_name') ?>

    <?php // echo $form->field($model, 'buyer_phone_number') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'quantity_shipped') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'item_price') ?>

    <?php // echo $form->field($model, 'item_tax') ?>

    <?php // echo $form->field($model, 'shipping_price') ?>

    <?php // echo $form->field($model, 'shipping_tax') ?>

    <?php // echo $form->field($model, 'gift_wrap_price') ?>

    <?php // echo $form->field($model, 'gift_wrap_tax') ?>

    <?php // echo $form->field($model, 'ship_service_level') ?>

    <?php // echo $form->field($model, 'recipient_name') ?>

    <?php // echo $form->field($model, 'ship_address_1') ?>

    <?php // echo $form->field($model, 'ship_address_2') ?>

    <?php // echo $form->field($model, 'ship_address_3') ?>

    <?php // echo $form->field($model, 'ship_city') ?>

    <?php // echo $form->field($model, 'ship_state') ?>

    <?php // echo $form->field($model, 'ship_postal_code') ?>

    <?php // echo $form->field($model, 'ship_country') ?>

    <?php // echo $form->field($model, 'ship_phone_number') ?>

    <?php // echo $form->field($model, 'bill_address_1') ?>

    <?php // echo $form->field($model, 'bill_address_2') ?>

    <?php // echo $form->field($model, 'bill_address_3') ?>

    <?php // echo $form->field($model, 'bill_city') ?>

    <?php // echo $form->field($model, 'bill_state') ?>

    <?php // echo $form->field($model, 'bill_postal_code') ?>

    <?php // echo $form->field($model, 'bill_country') ?>

    <?php // echo $form->field($model, 'item_promotion_discount') ?>

    <?php // echo $form->field($model, 'ship_promotion_discount') ?>

    <?php // echo $form->field($model, 'carrier') ?>

    <?php // echo $form->field($model, 'tracking_number') ?>

    <?php // echo $form->field($model, 'estimated_arrival_date') ?>

    <?php // echo $form->field($model, 'fulfillment_center_id') ?>

    <?php // echo $form->field($model, 'fulfillment_channel') ?>

    <?php // echo $form->field($model, 'sales_channel') ?>

    <?php // echo $form->field($model, 'fosdrd_date') ?>

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
