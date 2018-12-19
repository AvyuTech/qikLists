<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss("
.pricing-1 .btn:last-child {
    position: relative;
    border-radius: unset;
    padding: 5px;
}
");
$this->registerCss("
.wizard {
    margin: 20px auto;
    background: #eee;
    padding-left: 20px;
    padding-right: 20px;
    padding-bottom: 20px;
}

.wizard .nav-tabs {
    position: relative;
    margin: 40px auto;
    margin-bottom: 0;
    border-bottom-color: #e0e0e0;
}

.wizard > div.wizard-inner {
    position: relative;
}

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 50%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 50%;
}

.wizard li:after {
    content: \" \";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: \" \";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

.wizard .nav-tabs > li a:hover {
    background: transparent;
}

.wizard .tab-pane {
    position: relative;
    padding-top: 10px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: \" \";
        position: absolute;
        left: 35%;
    }
}
form div.required label.control-label:after {
    content:\" * \";
    color:red;
}
");

$this->registerJs('
$(document).ready(function () {
    //Initialize tooltips
    $(\'.nav-tabs > li a[title]\').tooltip();
});
');
$this->title= 'Sign Up';
$iDevId = (\Yii::$app->request->get('idev_id')) ?  \Yii::$app->request->get('idev_id') : ((Yii::$app->request->cookies['idevId']) ? (string)Yii::$app->request->cookies['idevId'] : null);

$this->registerJs("
$(function(){
    $('.discount-p a').click(function(){
        var inputId = $(this).attr('class');
        var couponCode = $('#'+inputId).val();
        var validPlan = '".Yii::$app->request->get('plan')."';
        var price = '".Yii::$app->request->get('price')."';
        
        if(couponCode != '') {
            $('.'+inputId).html('<span><img src=\'".Yii::getAlias('@web').'/images/loading.gif'."\' style=\'width:40px\'/></span>');
            $('.'+inputId+'-span').addClass('disabledSpan');
            //$('#'+inputId).prop('disabled', true);
        }
        
        $('.' + inputId + '-msg').html( '' ); //remove old msg.
        
        if(couponCode != '')
        {
            $.ajax({
                url: '".\yii\helpers\Url::to(['/site/check-coupon'])."',
                type: 'GET',
                data: {coupon : couponCode, price : price, validPlan : validPlan, btnId : inputId},
                dataType: 'json'
            }).done(function(data) {
                //console.log(data);
                if(data.status) {
                    $('.'+inputId+'-span').html('<h3>Please Wait...</h3>');
                }
                else {
                   //$('#'+inputId).prop('disabled', false); 
                }
                $('.'+inputId+'-span').html(data.planBtn);
                $('.' + inputId + '-msg').html( data.msg );
                $('.'+inputId).html('Apply');
                $('.'+inputId+'-span').removeClass('disabledSpan');
            }).fail(function(jqXHR, textStatus) {
                alert( 'Request failed: ' + textStatus );
                $('.'+inputId).html('Apply');
                $('.'+inputId+'-span').removeClass('disabledSpan');
                //$('#'+inputId).prop('disabled', false);
            });
        }
        return false;
    });
});
");

$diCode = Yii::$app->request->get('discount');
$pAmt = Yii::$app->request->get('price');
$discountedPrice = Yii::$app->data->getDiscountedPrice($pAmt, $diCode);

?>

<section class="bg--secondary text-center" style="padding-bottom: 10px">
    <div class="container">
        <?php if((Yii::$app->session->hasFlash('error') || !$discountedPrice) && $diCode) { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert">
                        <div class="alert__body">
                            <span><?= (!$discountedPrice) ? "Invalid Coupon Code : ".$diCode.". Please enter valid coupon code." : Yii::$app->session->getFlash('error'); ?></span>
                        </div>
                        <div class="alert__close">×</div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if(Yii::$app->session->hasFlash('success')) { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert bg--success">
                        <div class="alert__body">
                            <span><?= Yii::$app->session->getFlash('success'); ?></span>
                        </div>
                        <div class="alert__close">×</div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
            //$discountedPrice = $diCode = null;
            if(Yii::$app->request->get('price')) {
        ?>
            <div class="row" style="margin-top: 25px;">
                <div class="register-box" style="width: 60%;margin:auto">
                    <section>
                    <div class="col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Selected Plan</th>
                                <th><?= Yii::$app->request->get('plan'); ?></th>
                            </tr>
                            <tr>
                                <th>Payable Amount</th>
                                <th><?= "$ ".(($diCode) ? (($discountedPrice) ? $discountedPrice : Yii::$app->request->get('price')) : Yii::$app->request->get('price')); ?></th>
                            </tr>
                            <?php if(Yii::$app->request->get('discount')) { ?>
                                <tr>
                                    <th>Applied Coupon</th>
                                    <th><?= ($discountedPrice) ? Yii::$app->request->get('discount') : 'Invalid Coupon Code ('.Yii::$app->request->get('discount').')'; ?></th>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    </section>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="register-box" style="width: 60%;margin:auto">
                <section>
                    <div class="wizard text-left">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="<?= ($step == 1) ? 'active' : 'disabled'; ?>">
                                    <a href="<?= ($step == 1) ? \yii\helpers\Url::to(['/site/sign-up', 'step' => 1]) : 'javascript:void(0);'; ?>" title="Personal Information">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation" class="<?= ($step == 2) ? 'active' : 'disabled'; ?>">
                                    <a href="<?= ($step == 2) ? \yii\helpers\Url::to(['/site/sign-up', 'step' => 2]) : 'javascript:void(0);'; ?>" title="Payment Details">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-credit-card"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane <?= ($step == 1) ? 'active' : ''; ?>">
                                <?php if($step == 1) { ?>
                                    <?= $this->render('step-first-form', ['model' => $model, 'plan' => $plan]); ?>
                                <?php } ?>
                            </div>
                            <div class="tab-pane <?= ($step == 2) ? 'active' : ''; ?>">
                                <?php if($step == 2) { $model->scenario = 'step-second'; ?>
                                    <?= $this->render('step-second-form', ['model' => $model]); ?>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>
                Already member? <a href="<?= \yii\helpers\Url::to(['/site/login']); ?>" class="text-center" style="color: black">Login</a>
            </div>
        </div>
    </div>
</section>