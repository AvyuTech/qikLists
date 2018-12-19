<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReimbursementsReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reimbursements-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'approval_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reimbursement_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'case_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amazon_order_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fnsku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_per_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity_reimbursed_cash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity_reimbursed_inventory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity_reimbursed_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'original_reimbursement_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'original_reimbursement_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
