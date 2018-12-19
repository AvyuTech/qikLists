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
    color: #dd4b39 !important;
}
");
?>
<!--<div class="box-header with-border">
    <h3 class="box-title">Personal Details</h3>
</div>-->
<?php $form = ActiveForm::begin(['id' => 'signup-form-4', 'enableAjaxValidation' => true]); ?>
<div class="box-body">
    <div class="row">
        <!--<div class="col-sm-12 col-xs-12">
            <?php /*= $form->field($model, 'u_contact_no')->textInput(['placeholder' => 'Enter your Mobile No. for Mobile Verification']); */?>
        </div>-->
        <div class="col-sm-12 col-xs-12">
            <h3 class="box-title">Enter OTP which we have sent to your mobile no. for verification</h3>
        </div>
        <div class="col-sm-12 co-xs-12">
            <?= $form->field($model, 'u_otp')->textInput(['placeholder' => 'Enter OTP', 'required' => true]); ?>
        </div>
    </div>
</div>
<div class="box-footer">
    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary pull-right']); ?>
    <?= Html::a('Previous', ['/site/sign-up', 'step' => 3], ['class' => 'btn btn-default pull-right', 'title' => 'Previous', 'style' => 'margin-right:10px']); ?>
</div>
<?php ActiveForm::end(); ?>