<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderDataLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-data-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'odl_user_id')->textInput() ?>

    <?= $form->field($model, 'odl_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'odl_shipment_data')->textInput() ?>

    <?= $form->field($model, 'odl_refund_data')->textInput() ?>

    <?= $form->field($model, 'odl_service_fee_data')->textInput() ?>

    <?= $form->field($model, 'odl_adjustment_data')->textInput() ?>

    <?= $form->field($model, 'odl_shipped_order_data')->textInput() ?>

    <?= $form->field($model, 'odl_all_asin_data')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'odl_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
