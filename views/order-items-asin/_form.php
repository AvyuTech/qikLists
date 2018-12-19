<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItemsAsin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-items-asin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oia_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oia_asin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oia_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oia_referral_fee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'oia_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
