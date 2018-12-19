<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbaInboundShipmentPerformanceReportDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fba-inbound-shipment-performance-report-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fisprd_id') ?>

    <?= $form->field($model, 'issue_reported_date') ?>

    <?= $form->field($model, 'shipment_creation_date') ?>

    <?= $form->field($model, 'fba_shipment_id') ?>

    <?= $form->field($model, 'fba_carton_id') ?>

    <?php // echo $form->field($model, 'fulfillment_center_id') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'fnsku') ?>

    <?php // echo $form->field($model, 'asin') ?>

    <?php // echo $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'problem_type') ?>

    <?php // echo $form->field($model, 'problem_quantity') ?>

    <?php // echo $form->field($model, 'expected_quantity') ?>

    <?php // echo $form->field($model, 'received_quantity') ?>

    <?php // echo $form->field($model, 'performance_measurement_unit') ?>

    <?php // echo $form->field($model, 'fee_type') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'fee_total') ?>

    <?php // echo $form->field($model, 'problem_level') ?>

    <?php // echo $form->field($model, 'alert_status') ?>

    <?php // echo $form->field($model, 'fisprd_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
