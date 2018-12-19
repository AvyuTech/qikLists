<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemChargeListDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-charge-list-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'icld_id') ?>

    <?= $form->field($model, 'icld_amazon_order_id') ?>

    <?= $form->field($model, 'icld_seller_order_id') ?>

    <?= $form->field($model, 'icld_item_charge_type') ?>

    <?= $form->field($model, 'icld_charge_amount') ?>

    <?php // echo $form->field($model, 'icld_currency') ?>

    <?php // echo $form->field($model, 'icld_shipment_refund_event_data_id') ?>

    <?php // echo $form->field($model, 'icld_transaction_type') ?>

    <?php // echo $form->field($model, 'icld_item_type') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'icld_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
