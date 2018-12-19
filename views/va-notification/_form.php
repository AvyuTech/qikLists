<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VaNotification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="va-notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vn_va_id')->textInput() ?>

    <?= $form->field($model, 'vn_seller_id')->textInput() ?>

    <?= $form->field($model, 'vn_shipment_refund_event_data_id')->textInput() ?>

    <?= $form->field($model, 'vn_amazon_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vn_refund_posted_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vn_is_seen')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'vn_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
