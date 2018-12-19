<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductOffersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-offers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'po_id') ?>

    <?= $form->field($model, 'po_condition') ?>

    <?= $form->field($model, 'po_seller_feedback_rating') ?>

    <?= $form->field($model, 'po_seller_feedback_count') ?>

    <?= $form->field($model, 'po_listing_price') ?>

    <?php // echo $form->field($model, 'po_shipping_cost') ?>

    <?php // echo $form->field($model, 'po_is_amazon_fulfillment') ?>

    <?php // echo $form->field($model, 'po_is_buybox_winner') ?>

    <?php // echo $form->field($model, 'po_is_featured_merchant') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'po_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
