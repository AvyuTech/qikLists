<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderAdjustmentItemListData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-adjustment-item-list-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oaild_amazon_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaild_seller_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaild_quantity')->textInput() ?>

    <?= $form->field($model, 'oaild_per_unit_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaild_total_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaild_currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaild_seller_sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaild_fnsku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaild_product_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'oaild_asin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oaild_shipment_refund_event_data_id')->textInput() ?>

    <?= $form->field($model, 'order_adjustment_event_data_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'oaild_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
