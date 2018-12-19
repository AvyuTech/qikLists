<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserFetchedReportDataStatusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-fetched-report-data-status-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ufrds_id') ?>

    <?= $form->field($model, 'ufrds_reimbursement_report') ?>

    <?= $form->field($model, 'ufrds_return_report') ?>

    <?= $form->field($model, 'ufrds_inventory_adjustment_report') ?>

    <?= $form->field($model, 'ufrds_all_listing_report') ?>

    <?php // echo $form->field($model, 'ufrds_received_inventory_report') ?>

    <?php // echo $form->field($model, 'ufrds_restock_report') ?>

    <?php // echo $form->field($model, 'ufrds_all_order_report') ?>

    <?php // echo $form->field($model, 'ufrds_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'ufrds_user_id') ?>

    <?php // echo $form->field($model, 'ufrds_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
