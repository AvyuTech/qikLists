<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReimbursementsReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reimbursements-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rr_id') ?>

    <?= $form->field($model, 'approval_date') ?>

    <?= $form->field($model, 'reimbursement_id') ?>

    <?= $form->field($model, 'case_id') ?>

    <?= $form->field($model, 'amazon_order_id') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'fnsku') ?>

    <?php // echo $form->field($model, 'asin') ?>

    <?php // echo $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'condition') ?>

    <?php // echo $form->field($model, 'currency_unit') ?>

    <?php // echo $form->field($model, 'amount_per_unit') ?>

    <?php // echo $form->field($model, 'amount_total') ?>

    <?php // echo $form->field($model, 'quantity_reimbursed_cash') ?>

    <?php // echo $form->field($model, 'quantity_reimbursed_inventory') ?>

    <?php // echo $form->field($model, 'quantity_reimbursed_total') ?>

    <?php // echo $form->field($model, 'original_reimbursement_id') ?>

    <?php // echo $form->field($model, 'original_reimbursement_type') ?>

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
