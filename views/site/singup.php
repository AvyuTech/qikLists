<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

$this->title = 'Sign Up';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$fieldOptions3 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
?>
<div class="login-box">
    <?php
        if(Yii::$app->session->hasFlash('success')) {
            ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?= Yii::$app->session->getFlash('success'); ?>
            </div>
            <?php
        }
    ?>
    <div class="login-logo">
        <a href="<?= Yii::$app->homeUrl; ?>"><b>Price Genius</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign up</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableAjaxValidation' => true]); ?>

        <?= $form
            ->field($model, 'u_name', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('u_name')]) ?>

        <?= $form
            ->field($model, 'u_email', $fieldOptions3)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('u_email')]) ?>

        <?= $form
            ->field($model, 'u_password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('u_password')]) ?>

        <?= $form
            ->field($model, 'u_confirm_password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('u_confirm_password')]) ?>

        <div class="row">
            <div class="col-xs-12 col-sm-12 text-center">
                <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'sign-up-button']) ?>
            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>

        <br/>
        Already a member? <a href="<?= \yii\helpers\Url::to(['/site/login']); ?>" class="text-center">Sign In</a>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
