<?php

/* @var $this yii\web\View */

$this->title = 'Repriser';
$this->registerCss('
.info-box-number {
    font-size: 35px;
}
.ruleComp label, .ruleCompB label, .raisePrice label {
    display: block;
}
');

$this->registerJs("
    $(function(){
        $('.sb-1').click(function(e) {
            var ruleName = $('.ruleName').val();
            if(ruleName) {
                $('.sb-1').hide();
                $('.step-2').show();
            }
        });
        
        $('.sb-2').click(function(e) {
            var ruleGoal = $('.ruleGoal').val();
            if(ruleGoal) {
                $('.sb-2').hide();
                $('.step-3').show();
            }
        });
        
        $('.sb-3').click(function(e) {
            var ruleMatch = $('.ruleMatch').val();
            if(ruleMatch == 1 || ruleMatch == 3) {
                $('.sb-3').hide();
                $('.step-4').show();
            }
            
            if(ruleMatch == 2) {
                $('.sb-3').hide();
                $('.step-5').show();
            }
        });
        
        $('.sb-4').click(function(e) {
            var amountMatch = $('.amountMatch').val();
            var amountMatchPer = $('.amountMatchPer').val();
            if(amountMatch || amountMatchPer) {
                $('.sb-4').hide();
                $('.step-5').show();
            }
        });
        
        $('.sb-5').click(function(e) {
            $('.sb-5').hide();
            $('.step-6').show();
        });
        
        $('.sb-6').click(function(e) {
            var raisePrice = $('.raisePrice input[name=raisePrice]:checked').val();
            
            if(raisePrice == 2) {
                $('.sb-6').hide();
                $('.step-6a').show();
            } else {
                $('.sb-6').hide();
                $('.step-6b').show();
            }
        });
        
        $('.sb-6a').click(function(e) {
            $('.sb-6a').hide();
            $('.step-6b').show();
        });
    });
");
?>

<?php
    if(Yii::$app->request->get('s')) {
        ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    You have successfully submitted Reprice.
            </div>
        <?php
    }
?>
<?= \yii\helpers\Html::beginForm(); ?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Set Reprice</h3>
    </div>
    <div class="box-body">
        <div class="row step-1">
            <div class="col-xs-12 col-sm-12">
                <h3> <i class="fa fa-info-circle"></i> Define Rule Name</h3>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?= \yii\helpers\Html::label('How do you want to name this rule?', ['class' => 'control-label']); ?>
                <?= \yii\helpers\Html::textInput('ruleName', null, ['class' => 'form-control ruleName']); ?>
            </div>
            <div class="col-xs-12 col-sm-6" style="margin-top: 25px;">
                <?= \yii\helpers\Html::button('Submit', ['class' => 'btn btn-primary btn-sm btn-flat sb-1']); ?>
            </div>
        </div>
        <div class="row step-2" style="display: none;">
            <hr>
            <div class="col-xs-12 col-sm-12">
                <h3><i class="fa fa-info-circle"></i> Define Rule Goal</h3>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?= \yii\helpers\Html::label('Price you want to compare to:', ['class' => 'control-label']); ?>
                <?= \yii\helpers\Html::dropDownList('ruleGoal', null, ['' => '--- Select Rule Goal ---', 'bbp' => 'Buy Box Price', 'lp' => 'Lowest Price'], ['class' => 'form-control ruleGoal']); ?>
            </div>
            <div class="col-xs-12 col-sm-6" style="margin-top: 25px;">
                <?= \yii\helpers\Html::button('Submit', ['class' => 'btn btn-primary btn-sm btn-flat sb-2']); ?>
            </div>
        </div>
        <div class="row step-3" style="display: none;">
            <hr>
            <div class="col-xs-12 col-sm-12">
                <h3><i class="fa fa-info-circle"></i> How to match</h3>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?= \yii\helpers\Html::label('Price action you want us to take:', ['class' => 'control-label']); ?>
                <?= \yii\helpers\Html::dropDownList('ruleMatch', null, ['' => '--- Select Match ---', '1' => 'Stay below th e Buy Box price by a specified amount', '2' => 'Match price exactly', '3' => 'Stay above price by a specified amount'], ['class' => 'form-control ruleMatch']); ?>
            </div>
            <div class="col-xs-12 col-sm-6" style="margin-top: 25px;">
                <?= \yii\helpers\Html::button('Submit', ['class' => 'btn btn-primary btn-sm btn-flat sb-3']); ?>
            </div>
        </div>
        <div class="row step-4" style="display: none;">
            <hr>
            <div class="col-xs-12 col-sm-12">
                <h3><i class="fa fa-info-circle"></i> Set Amount</h3>
            </div>
            <div class="col-xs-12 col-sm-8">
                <div class="col-xs-12 col-sm-6">
                    <?= \yii\helpers\Html::label('Price action you want us to take:', ['class' => 'control-label']); ?>
                    <?= \yii\helpers\Html::dropDownList('ruleMatch', null, ['' => '--- Select Match ---', '1' => 'Stay below th e Buy Box price by a specified amount', '3' => 'Stay above price by a specified amount'], ['class' => 'form-control ruleMatchExtra']); ?>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="col-xs-12 col-sm-12">
                        <?= \yii\helpers\Html::label('Amount', ['class' => 'control-label']); ?>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <?= \yii\helpers\Html::textInput('amountMatch', null, ['type' => 'number', 'class' => 'form-control amountMatch', 'placeholder' => 'Amount in $']); ?>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <p>OR</p>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <?= \yii\helpers\Html::textInput('amountMatchPer', null, ['type' => 'number', 'class' => 'form-control amountMatchPer', 'placeholder' => 'Value in %']); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4" style="margin-top: 25px;">
                <?= \yii\helpers\Html::button('Submit', ['class' => 'btn btn-primary btn-sm btn-flat sb-4']); ?>
            </div>
        </div>
        <div class="row step-5" style="display: none;">
            <hr>
            <div class="col-xs-12 col-sm-12">
                <h3><i class="fa fa-info-circle"></i> Rule Comparison</h3>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?= \yii\helpers\Html::label('Select option:', ['class' => 'control-label']); ?>
                <?= \yii\helpers\Html::radioList('ruleComp', null, ['1' => 'All offers for the same ASIN and condition', '2' => 'Only offers with the same fulfillment method', '3' => 'If no offers for the same ASIN and condition available, then all offers with the same fulfillment method'], ['class' => 'ruleComp']); ?>
                <?= \yii\helpers\Html::checkbox('inAmazon', null, ['label' => 'Ignore Amazon', 'class' => '', 'style' => 'margin-top:10px;']); ?>
            </div>
            <div class="col-xs-12 col-sm-6" style="margin-top: 25px;">
                <?= \yii\helpers\Html::button('Submit', ['class' => 'btn btn-primary btn-sm btn-flat sb-5']); ?>
            </div>
        </div>
        <div class="row step-6" style="display: none;">
            <hr>
            <div class="col-xs-12 col-sm-12">
                <h3><i class="fa fa-info-circle"></i> Raise Price</h3>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?= \yii\helpers\Html::label('Raise your price if you are the only seller winning the buybox?', ['class' => 'control-label']); ?>
                <?= \yii\helpers\Html::radioList('raisePrice', null, ['1' => 'Match next price above yours', '2' => 'Stay below next price above yours by a specified amount'], ['class' => 'raisePrice']); ?>
            </div>
            <div class="col-xs-12 col-sm-6" style="margin-top: 25px;">
                <?= \yii\helpers\Html::button('Submit', ['class' => 'btn btn-primary btn-sm btn-flat sb-6']); ?>
            </div>
        </div>
        <div class="row step-6a" style="display: none;">
            <hr>
            <div class="col-xs-12 col-sm-12">
                <h3><i class="fa fa-info-circle"></i> Set Amount</h3>
            </div>
            <div class="col-xs-12 col-sm-8">
                <div class="col-xs-12 col-sm-6">
                    <?= \yii\helpers\Html::label('Price action you want us to take:', ['class' => 'control-label']); ?>
                    <?= \yii\helpers\Html::dropDownList('ruleMatchA', null, ['' => '--- Select Match ---', '1' => 'Stay below th e Buy Box price by a specified amount', '3' => 'Stay above price by a specified amount'], ['class' => 'form-control ruleMatchExtraA']); ?>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="col-xs-12 col-sm-12">
                        <?= \yii\helpers\Html::label('Amount', ['class' => 'control-label']); ?>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <?= \yii\helpers\Html::textInput('amountMatchA', null, ['type' => 'number', 'class' => 'form-control amountMatchA', 'placeholder' => 'Amount in $']); ?>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <p>OR</p>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <?= \yii\helpers\Html::textInput('amountMatchPerA', null, ['type' => 'number', 'class' => 'form-control amountMatchPerA', 'placeholder' => 'Value in %']); ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4" style="margin-top: 25px;">
                <?= \yii\helpers\Html::button('Submit', ['class' => 'btn btn-primary btn-sm btn-flat sb-6a']); ?>
            </div>
        </div>
        <div class="row step-6b" style="display: none;">
            <hr>
            <div class="col-xs-12 col-sm-12">
                <h3><i class="fa fa-info-circle"></i> Raise Price: Comparison</h3>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?= \yii\helpers\Html::label('Select option:', ['class' => 'control-label']); ?>
                <?= \yii\helpers\Html::radioList('ruleCompB', null, ['1' => 'All offers for the same ASIN and condition', '2' => 'Only offers with the same fulfillment method', '3' => 'If no offers for the same ASIN and condition available, then all offers with the same fulfillment method'], ['class' => 'ruleCompB']); ?>
                <?= \yii\helpers\Html::checkbox('inAmazonB', null, ['label' => 'Ignore Amazon', 'class' => '', 'style' => 'margin-top:10px;']); ?>
            </div>
            <div class="col-xs-12 col-sm-6" style="margin-top: 25px;">
                <?= \yii\helpers\Html::a('Submit', ['/site/select-sku'], ['class' => 'btn btn-primary btn-sm btn-flat sb-6b']); ?>
            </div>
        </div>
    </div>
</div>
<?= \yii\helpers\Html::endForm(); ?>