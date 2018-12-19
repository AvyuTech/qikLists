<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div class="box-body">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'u_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'u_email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'u_password')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'u_confirm_password')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'u_contact_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'u_address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'u_type')->dropDownList($model->getUserType(), ['prompt' => '--- Select User Type ---']) ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($model, 'u_store_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <?= $form->field($model, 'u_photo')->fileInput() ?>
        </div>
    </div>
</div>
<div class="box-footer">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-default']); ?>
</div>
<?php ActiveForm::end(); ?>
