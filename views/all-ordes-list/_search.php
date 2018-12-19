<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AllOrdesListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="all-ordes-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'aol_id') ?>

    <?= $form->field($model, 'aol_amazon_order_id') ?>

    <?= $form->field($model, 'aol_seller_order_id') ?>

    <?= $form->field($model, 'aol_purchase_date') ?>

    <?= $form->field($model, 'aol_last_updated_date') ?>

    <?php // echo $form->field($model, 'aol_order_status') ?>

    <?php // echo $form->field($model, 'aol_fulfilment_channel') ?>

    <?php // echo $form->field($model, 'aol_sales_channel') ?>

    <?php // echo $form->field($model, 'aol_ship_service') ?>

    <?php // echo $form->field($model, 'aol_order_total') ?>

    <?php // echo $form->field($model, 'aol_shipped_items') ?>

    <?php // echo $form->field($model, 'aol_unshipped_items') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'aol_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
