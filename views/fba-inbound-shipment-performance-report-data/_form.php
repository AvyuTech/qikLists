<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbaInboundShipmentPerformanceReportData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fba-inbound-shipment-performance-report-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'issue_reported_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shipment_creation_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fba_shipment_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fba_carton_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fulfillment_center_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fnsku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'problem_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'problem_quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expected_quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'received_quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'performance_measurement_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fee_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fee_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'problem_level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alert_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fisprd_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
