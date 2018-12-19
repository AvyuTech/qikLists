<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

$this->title = 'Price Genius | '.Yii::t('app', 'Forgot password');

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}"
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
        <a href="<?= Yii::$app->homeUrl; ?>">Price Genius</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Enter new password for reset</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'password', $fieldOptions1)->passwordInput(['placeholder' => Yii::t('app', 'Enter your new password'), 'class' => 'form-control input-lg']) ?>

        <?= $form->field($model, 'confirm_password', $fieldOptions1)->passwordInput(['placeholder' => Yii::t('app', 'Re-enter your new  password'), 'class' => 'form-control input-lg']) ?>

        <div class="row">
            <div class="col-xs-4">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->