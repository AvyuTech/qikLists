<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbaInventoryDetailsReportData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fba-inventory-details-report-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'snapshot_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fnsku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fulfillment_center_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'disposition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fidrd_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
