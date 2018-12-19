<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserActivityLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-activity-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ual_id') ?>

    <?= $form->field($model, 'ual_user_id') ?>

    <?= $form->field($model, 'ual_user_ip') ?>

    <?= $form->field($model, 'ual_request_url') ?>

    <?= $form->field($model, 'ual_message') ?>

    <?php // echo $form->field($model, 'ual_time_spent') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
