<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ShipmentRefundEventData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shipment-refund-event-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sred_amazon_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sred_seller_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sred_marketplace_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sred_shipment_posted_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sred_refund_posted_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sred_seller_sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sred_order_item_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sred_order_adjustment_item_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sred_quantity_shipped')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'sred_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
