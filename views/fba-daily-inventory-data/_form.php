<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FbaDailyInventoryData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fba-daily-inventory-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'snapshot_date')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fnsku')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sku')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'product_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'quantity')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fulfillment_center_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'detailed_disposition')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fdid_date')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
