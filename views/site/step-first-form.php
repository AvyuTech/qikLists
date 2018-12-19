<?php
/**
 * Created by PhpStorm.
 * User: gamitg
 * Date: 5/10/17
 * Time: 6:18 PM
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Sign Up';
$this->registerCss("
#user-u_position label{ 
    margin-right: 20px;
}
");
?>
<!--<div class="box-header with-border">
    <h3 class="box-title">Personal Details</h3>
</div>-->
<?php $form = ActiveForm::begin(['id' => 'signup-form-1', 'enableAjaxValidation' => true]); ?>
<div class="box-body">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <?= $form->field($model, 'u_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12 col-xs-12">
            <?= $form->field($model, 'u_email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12 col-xs-12">
            <?php /*= $form->field($model, 'u_contact_no')->textInput(['maxlength' => true]) */?>
            <?= $form->field($model, 'u_contact_no')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+1 999-999-9999',
            ]) ?>
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
</div>
<div class="box-footer">
    <?= Html::submitButton(($plan == 'free') ? 'Sign Up' : 'Continue', ['class' => 'btn btn-primary pull-right', 'title' => 'Continue']); ?>
</div>
<?php ActiveForm::end(); ?>