<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceFeeDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-fee-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sfd_id') ?>

    <?= $form->field($model, 'sfd_amazon_order_id') ?>

    <?= $form->field($model, 'sfd_seller_order_id') ?>

    <?= $form->field($model, 'sfd_fee_reason') ?>

    <?= $form->field($model, 'sfd_fee_type') ?>

    <?php // echo $form->field($model, 'sfd_fee_amount') ?>

    <?php // echo $form->field($model, 'sfd_currency') ?>

    <?php // echo $form->field($model, 'sfd_seller_sku') ?>

    <?php // echo $form->field($model, 'sfd_fnsku') ?>

    <?php // echo $form->field($model, 'sfd_fee_description') ?>

    <?php // echo $form->field($model, 'sfd_asin') ?>

    <?php // echo $form->field($model, 'sfd_shipment_refund_event_data_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'sfd_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
