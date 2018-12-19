<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Amazon MWS Credentials';
?>
<div class="box box-success">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <?= $form->field($model, 'u_mws_seller_id')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-12 col-xs-12">
                <?= $form->field($model, 'u_mws_auth_token')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Submit' : 'Submit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>