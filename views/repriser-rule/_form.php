<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RepriserRule */
/* @var $form yii\widgets\ActiveForm */

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

<?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="row step-1">
            <div class="col-xs-12 col-sm-12">
                <h3> <i class="fa fa-info-circle"></i> Define Rule Name</h3>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?= \yii\helpers\Html::label('How do you want to name this rule?', ['class' => 'control-label']); ?>
                <?= $form->field($model, 'rr_name')->textInput(['maxlength' => true, 'class' => 'form-control ruleName'])->label(false); ?>
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
                <?= $form->field($model, 'rr_goal')->dropDownList(['bbp' => 'Buy Box Price', 'lp' => 'Lowest Price'], ['prompt' => '--- Select Rule Goal ---', 'class' => 'form-control ruleGoal'])->label(false); ?>
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
                <?= $form->field($model, 'rr_match_action')->dropDownList(['1' => 'Stay below th e Buy Box price by a specified amount', '2' => 'Match price exactly', '3' => 'Stay above price by a specified amount'], ['prompt' => '--- Select Match ---', 'class' => 'form-control ruleMatch'])->label(false); ?>
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
                    <?= $form->field($model, 'rr_pricing_action')->dropDownList(['1' => 'Stay below th e Buy Box price by a specified amount', '2' => 'Stay above price by a specified amount'], ['prompt' => '--- Select Action ---', 'class' => 'form-control ruleMatchExtra'])->label(false); ?>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="col-xs-12 col-sm-12">
                        <?= \yii\helpers\Html::label('Amount', ['class' => 'control-label']); ?>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <?= $form->field($model, 'rr_pricing_amount')->textInput(['type' => 'number', 'class' => 'form-control amountMatch', 'placeholder' => 'Amount in $'])->label(false); ?>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <p>OR</p>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <?= $form->field($model, 'rr_pricing_percentage')->textInput(['type' => 'number', 'class' => 'form-control amountMatchPer', 'placeholder' => 'Value in %'])->label(false); ?>
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
                <?= $form->field($model, 'rr_rule_comparison')->radioList(['1' => 'All offers for the same ASIN and condition', '2' => 'Only offers with the same fulfillment method'], ['class' => 'ruleComp'])->label(false); //'3' => 'If no offers for the same ASIN and condition available, then all offers with the same fulfillment method' ?>
                <?= $form->field($model, 'rr_rule_comparison_ignore_amazon')->checkbox(['label' => 'Ignore Amazon', 'class' => '', 'style' => 'margin-top:10px;']) ?>
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
                <?= $form->field($model, 'rr_raise_price')->radioList(['1' => 'Match next price above yours', '2' => 'Stay below next price above yours by a specified amount'], ['class' => 'raisePrice'])->label(false); ?>
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
                    <?= $form->field($model, 'rr_raise_price_action')->dropDownList(['1' => 'Stay below th e Buy Box price by a specified amount', '2' => 'Stay above price by a specified amount'], ['prompt' => '--- Select Match ---', 'class' => 'form-control ruleMatchExtraA'])->label(false); ?>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="col-xs-12 col-sm-12">
                        <?= \yii\helpers\Html::label('Amount', ['class' => 'control-label']); ?>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <?= $form->field($model, 'rr_raise_price_amount')->textInput(['type' => 'number', 'class' => 'form-control amountMatchA', 'placeholder' => 'Amount in $'])->label(false); ?>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <p>OR</p>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <?= $form->field($model, 'rr_raise_price_percentage')->textInput(['type' => 'number', 'class' => 'form-control amountMatchPerA', 'placeholder' => 'Value in %'])->label(false); ?>
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
                <?= $form->field($model, 'rr_raise_price_comparison')->radioList(['1' => 'All offers for the same ASIN and condition', '2' => 'Only offers with the same fulfillment method', '3' => 'If no offers for the same ASIN and condition available, then all offers with the same fulfillment method'], ['class' => 'ruleCompB'])->label(false); ?>

                <?= $form->field($model, 'rr_raise_price_comparison_ignore_amazon')->checkbox(['label' => 'Ignore Amazon', 'class' => '', 'style' => 'margin-top:10px;']) ?>
            </div>
            <div class="col-xs-12 col-sm-6" style="margin-top: 25px;">
                <?= \yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-primary btn-sm btn-flat sb-6b']); ?>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>