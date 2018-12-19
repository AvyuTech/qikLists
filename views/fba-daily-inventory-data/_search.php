<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbaDailyInventoryDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fba-daily-inventory-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fdid_id') ?>

    <?= $form->field($model, 'snapshot_date') ?>

    <?= $form->field($model, 'fnsku') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'fulfillment_center_id') ?>

    <?php // echo $form->field($model, 'detailed_disposition') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'fdid_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
