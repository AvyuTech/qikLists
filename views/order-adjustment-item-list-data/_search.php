<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderAdjustmentItemListDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-adjustment-item-list-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'oaild_id') ?>

    <?= $form->field($model, 'oaild_amazon_order_id') ?>

    <?= $form->field($model, 'oaild_seller_order_id') ?>

    <?= $form->field($model, 'oaild_quantity') ?>

    <?= $form->field($model, 'oaild_per_unit_amount') ?>

    <?php // echo $form->field($model, 'oaild_total_amount') ?>

    <?php // echo $form->field($model, 'oaild_currency') ?>

    <?php // echo $form->field($model, 'oaild_seller_sku') ?>

    <?php // echo $form->field($model, 'oaild_fnsku') ?>

    <?php // echo $form->field($model, 'oaild_product_description') ?>

    <?php // echo $form->field($model, 'oaild_asin') ?>

    <?php // echo $form->field($model, 'oaild_shipment_refund_event_data_id') ?>

    <?php // echo $form->field($model, 'order_adjustment_event_data_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'oaild_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
