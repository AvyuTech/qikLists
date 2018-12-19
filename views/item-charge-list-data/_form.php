<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemChargeListData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-charge-list-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'icld_amazon_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icld_seller_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icld_item_charge_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icld_charge_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icld_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icld_shipment_refund_event_data_id')->textInput() ?>

    <?= $form->field($model, 'icld_transaction_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icld_item_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'icld_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
