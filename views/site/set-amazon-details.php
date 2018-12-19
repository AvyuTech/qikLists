<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Set Amazon Credentials');
$this->registerJs("(function($) {
      $('#amazonModal').modal();
  })(jQuery);", yii\web\View::POS_END, 'amazon');
$this->registerJsFile(Yii::getAlias('@web').'/js/disable-submit-buttons.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCss("
.modal-body {
    padding: 0px 15px;
}
.form-control {
    padding: 18px 10px;
}
.successBtn {
    padding: 12px 10px;
}
");
?>

<?php $form = ActiveForm::begin(); ?>
<?php
yii\bootstrap\Modal::begin([
    'id' => 'amazonModal',
    'size' => \yii\bootstrap\Modal::SIZE_LARGE,
    'header' => "<h4 class=\"modal-title\">".Html::encode('Set Amazon MWS Credentials')."</h4>",
    'footer' => Html::a(Yii::t('app', 'Login'), ['/site/login'], ['class' => 'btn btn-default pull-left']),
    //'footer' => false,
    'closeButton' => false,
    'options' => ['data-backdrop' => 'static', 'data-keyboard' => 'false']
]);
?>
<div class="row">
    <div class="col-sm-6 col-xs-12" style="padding: 15px;">
        <div class="col-sm-12 col-xs-12">
            <?= $form->field($model, 'u_mws_seller_id')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12 col-xs-12">
            <div class="form-group">
                <?= Html::label('Marketplace ID <br/><small>(Amazon.com only at this time)</small>'); ?>
                <?= Html::textInput('marketPlaceId', 'ATVPDKIKX0DER', ['disabled' => true, 'class' => 'form-control'])?>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12">
            <?= $form->field($model, 'u_mws_auth_token')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12 col-xs-12">
            <?= Html::submitButton(Yii::t('app', '<b>Submit</b>'), ['class' => 'btn btn-block successBtn btn-info pull-left']);  ?>
        </div>
    </div>
    <div class="col-sm-6 col-xs-12" style="border-left: 1px solid #ccc;padding: 15px;background-color: #eee;">
        <p style="font-weight: bold">
            1. Click here to visit <a href="https://sellercentral.amazon.com/gp/mws/registration/register.html?devAuth=1&devMWSAccountId=7436-1811-9340&developerName=Price%20Genius&ie=UTF8&signInPageDisplayed=1" target="_blank">Amazon Marketplace Web Service</a> (Amazon MWS) registration page.
        </p>
        <p style="font-weight: bold">
            2. Choose the 3rd option "I want to authorize a developer to access my Amazon seller account with Amazon MWS."
        </p>
        <p style="font-weight: bold">
            3. For "Developer Name" enter <span class="text-info">Price Genius</span> and for "Application's Developer Account Number" enter <span class="text-info">7436-1811-9340</span>
        </p>
        <p style="font-weight: bold">
            4. Then copy and paste your Seller ID and Auth token here on this page, and click the Blue "Submit" button.
        </p>

        <p>
            <p>Check the screenshots below for more details.</p>
            <span>
                <?= Html::a(Html::img(Yii::getAlias('@web').'/images/amazon_second_step.png', ['title' => 'Step Second', 'style' => 'width:150px;height:90px']), Yii::getAlias('@web').'/images/amazon_second_step.png', ['target' => '_blank']); ?>
                <?= Html::a(Html::img(Yii::getAlias('@web').'/images/amazon_third_step.png', ['title' => 'Third Second', 'style' => 'width:150px;height:90px']), Yii::getAlias('@web').'/images/amazon_third_step.png', ['target' => '_blank']); ?>
            </span>
        </p>
    </div>
</div>
<?php yii\bootstrap\Modal::end(); ?>
<?php ActiveForm::end(); ?>


