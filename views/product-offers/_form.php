<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductOffers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-offers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'po_condition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'po_seller_feedback_rating')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'po_seller_feedback_count')->textInput() ?>

    <?= $form->field($model, 'po_listing_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'po_shipping_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'po_is_amazon_fulfillment')->textInput() ?>

    <?= $form->field($model, 'po_is_buybox_winner')->textInput() ?>

    <?= $form->field($model, 'po_is_featured_merchant')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'po_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
