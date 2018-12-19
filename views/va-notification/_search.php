<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VaNotificationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="va-notification-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'vn_id') ?>

    <?= $form->field($model, 'vn_va_id') ?>

    <?= $form->field($model, 'vn_seller_id') ?>

    <?= $form->field($model, 'vn_shipment_refund_event_data_id') ?>

    <?= $form->field($model, 'vn_amazon_order_id') ?>

    <?php // echo $form->field($model, 'vn_refund_posted_date') ?>

    <?php // echo $form->field($model, 'vn_is_seen') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'vn_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
