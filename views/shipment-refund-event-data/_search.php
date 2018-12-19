<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShipmentRefundEventDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shipment-refund-event-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sred_id') ?>

    <?= $form->field($model, 'sred_amazon_order_id') ?>

    <?= $form->field($model, 'sred_seller_order_id') ?>

    <?= $form->field($model, 'sred_marketplace_name') ?>

    <?= $form->field($model, 'sred_shipment_posted_date') ?>

    <?php // echo $form->field($model, 'sred_refund_posted_date') ?>

    <?php // echo $form->field($model, 'sred_seller_sku') ?>

    <?php // echo $form->field($model, 'sred_order_item_id') ?>

    <?php // echo $form->field($model, 'sred_order_adjustment_item_id') ?>

    <?php // echo $form->field($model, 'sred_quantity_shipped') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'sred_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
