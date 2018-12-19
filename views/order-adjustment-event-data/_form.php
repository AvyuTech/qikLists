<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderAdjustmentEventData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-adjustment-event-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oaed_amazon_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaed_seller_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaed_adjustment_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaed_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaed_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaed_shipment_refund_event_data_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'oaed_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
