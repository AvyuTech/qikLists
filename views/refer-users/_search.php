<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReferUsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refer-users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ru_id') ?>

    <?= $form->field($model, 'ru_refer_user_id') ?>

    <?= $form->field($model, 'ru_used_promo_code') ?>

    <?= $form->field($model, 'ru_plan') ?>

    <?= $form->field($model, 'ru_refer_date') ?>

    <?php // echo $form->field($model, 'ru_refered_by') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'ru_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
