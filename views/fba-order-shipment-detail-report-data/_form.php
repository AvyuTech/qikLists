<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbaOrderShipmentDetailReportData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fba-order-shipment-detail-report-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amazon_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'merchant_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipment_item_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amazon_order_item_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'merchant_order_item_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchase_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payments_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipment_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reporting_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buyer_phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity_shipped')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipping_tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gift_wrap_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gift_wrap_tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_service_level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recipient_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_address_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_address_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_address_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_postal_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_address_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_address_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_address_3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_postal_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bill_country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'item_promotion_discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ship_promotion_discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carrier')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tracking_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estimated_arrival_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fulfillment_center_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fulfillment_channel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_channel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fosdrd_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
