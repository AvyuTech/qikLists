<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserFetchedReportDataStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-fetched-report-data-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ufrds_reimbursement_report')->textInput() ?>

    <?= $form->field($model, 'ufrds_return_report')->textInput() ?>

    <?= $form->field($model, 'ufrds_inventory_adjustment_report')->textInput() ?>

    <?= $form->field($model, 'ufrds_all_listing_report')->textInput() ?>

    <?= $form->field($model, 'ufrds_received_inventory_report')->textInput() ?>

    <?= $form->field($model, 'ufrds_restock_report')->textInput() ?>

    <?= $form->field($model, 'ufrds_all_order_report')->textInput() ?>

    <?= $form->field($model, 'ufrds_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'ufrds_user_id')->textInput() ?>

    <?= $form->field($model, 'ufrds_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
