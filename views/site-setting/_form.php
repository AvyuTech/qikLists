<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SiteSetting */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="box-body">

    <?= $form->field($model, 'ss_default_coupon_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ss_payout_percentage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ss_payout_months')->textInput(['maxlength' => true]) ?>

</div>
<div class="box-footer">
    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
