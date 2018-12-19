<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemFeeListDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-fee-list-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ifld_id') ?>

    <?= $form->field($model, 'ifld_amazon_order_id') ?>

    <?= $form->field($model, 'ifld_seller_order_id') ?>

    <?= $form->field($model, 'ifld_fee_type') ?>

    <?= $form->field($model, 'ifld_fee_amount') ?>

    <?php // echo $form->field($model, 'ifld_currency') ?>

    <?php // echo $form->field($model, 'ifld_transaction_type') ?>

    <?php // echo $form->field($model, 'ifld_item_type') ?>

    <?php // echo $form->field($model, 'ifld_shipment_refund_event_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'ifld_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
