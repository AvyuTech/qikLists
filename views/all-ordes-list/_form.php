<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AllOrdesList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="all-ordes-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aol_amazon_order_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aol_seller_order_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aol_purchase_date')->textInput() ?>

    <?= $form->field($model, 'aol_last_updated_date')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aol_order_status')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aol_fulfilment_channel')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aol_sales_channel')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aol_ship_service')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'aol_order_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aol_shipped_items')->textInput() ?>

    <?= $form->field($model, 'aol_unshipped_items')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'aol_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
