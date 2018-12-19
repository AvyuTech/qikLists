<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss('
.radio input[type="radio"], 
.radio-inline input[type="radio"], 
.checkbox input[type="checkbox"], 
.checkbox-inline input[type="checkbox"] {
    margin-left:0px;
}
.checkbox {
    margin-top:0px;
}
');
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
    <!--<div class="row">
        <div class="col-sm-6 col-xs-12">
            <?php /*= $form->field($model, 'u_contact_no')->textInput(['maxlength' => true]) */?>
        </div>
        <div class="col-sm-6 col-xs-12">
            <?php /*= $form->field($model, 'u_address')->textInput(['maxlength' => true]) */?>
        </div>
    </div>-->
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <?= $form->field($employee, 'e_roles')->checkboxList($employee->getEmployeePermission(), [
                'item' => function($index, $label, $name, $checked, $value) {
                    $checked = ($checked) ? 'checked' : '';
                    $return = '<div class="checkbox checkbox-success">';
                    $return .= '<input type="checkbox" id="chk'.$index.'" name="' . $name . '" value="' . $value . '" '.$checked.'>';
                    $return .= '<label for="chk'.$index.'"> &nbsp; <strong>' . ucwords($label) . '</strong></label>';
                    $return .= '</div>';

                    return $return;
                }
            ]) ?>
        </div>
    </div>
    <!--/row-->
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <?= $form->field($model, 'u_photo')->fileInput() ?>
        </div>
    </div>
</div>
<div class="box-footer">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?= Html::a('Cancel', ['va-list'], ['class' => 'btn btn-default']); ?>
</div>
<?php ActiveForm::end(); ?>
