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
.disText label {
    font-size: 20px;
    color: #dd4b39 !important;
}
");
?>
<!--<div class="box-header with-border">
    <h3 class="box-title">Personal Details</h3>
</div>-->
<?php $form = ActiveForm::begin(['id' => 'signup-form-3', 'enableAjaxValidation' => true]); ?>
<div class="box-body">
    <h4 style="font-weight: bold">Aadhaar & PAN Details</h4>
    <hr/>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($aadharModel, 'uad_aadhar_no')->textInput(['maxlength' => true, 'type' => 'number']) ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($panModel, 'upd_pan_no')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($aadharModel, 'uad_aadhar_document_file', ['enableAjaxValidation' => false])->fileInput() ?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($panModel, 'upd_pan_document_file', ['enableAjaxValidation' => false])->fileInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xs-12 disText">
            <?= Html::checkbox('agreeAadhar', false, ['value' => 1, 'required' => true, 'label' => 'I agree to the Terms & Conditions and Consent to store my Aadhaar number and PAN number in encrypted format for completing my minimum KYC'])?>
        </div>
    </div>
</div>
<div class="box-footer">
    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary pull-right']); ?>
    <?= Html::a('Previous', ['/site/sign-up', 'step' => 2], ['class' => 'btn btn-default pull-right', 'title' => 'Previous', 'style' => 'margin-right:10px']); ?>
</div>
<?php ActiveForm::end(); ?>