<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderDataLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-data-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'odl_id') ?>

    <?= $form->field($model, 'odl_user_id') ?>

    <?= $form->field($model, 'odl_order_id') ?>

    <?= $form->field($model, 'odl_shipment_data') ?>

    <?= $form->field($model, 'odl_refund_data') ?>

    <?php // echo $form->field($model, 'odl_service_fee_data') ?>

    <?php // echo $form->field($model, 'odl_adjustment_data') ?>

    <?php // echo $form->field($model, 'odl_shipped_order_data') ?>

    <?php // echo $form->field($model, 'odl_all_asin_data') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'odl_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
