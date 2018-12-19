<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceFeeData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-fee-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sfd_amazon_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfd_seller_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfd_fee_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfd_fee_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfd_fee_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfd_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfd_seller_sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfd_fnsku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfd_fee_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sfd_asin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sfd_shipment_refund_event_data_id')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'sfd_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
