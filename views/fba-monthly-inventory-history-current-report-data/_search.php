<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbaMonthlyInventoryHistoryCurrentReportDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fba-monthly-inventory-history-current-report-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fmihcrd_id') ?>

    <?= $form->field($model, 'month') ?>

    <?= $form->field($model, 'fnsku') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'average_quantity') ?>

    <?php // echo $form->field($model, 'end_quantity') ?>

    <?php // echo $form->field($model, 'fulfillment_center_id') ?>

    <?php // echo $form->field($model, 'detailed_disposition') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'fmihcrd_date') ?>

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
