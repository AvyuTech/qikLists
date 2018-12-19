<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderAdjustmentEventDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-adjustment-event-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'oaed_id') ?>

    <?= $form->field($model, 'oaed_amazon_order_id') ?>

    <?= $form->field($model, 'oaed_seller_order_id') ?>

    <?= $form->field($model, 'oaed_adjustment_type') ?>

    <?= $form->field($model, 'oaed_amount') ?>

    <?php // echo $form->field($model, 'oaed_currency') ?>

    <?php // echo $form->field($model, 'oaed_shipment_refund_event_data_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'oaed_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
