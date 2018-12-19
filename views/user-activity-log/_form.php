<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserActivityLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-activity-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ual_user_id')->textInput() ?>

    <?= $form->field($model, 'ual_user_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ual_request_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ual_message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ual_time_spent')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
