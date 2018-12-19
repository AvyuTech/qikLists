<?php
/**
 * Created by PhpStorm.
 * User: gamitg
 * Date: 5/10/17
 * Time: 6:18 PM
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Sign Up';
$this->registerCss("
#user-u_position label{ 
    margin-right: 20px;
}
");
$this->registerJsFile("https://js.stripe.com/v3/");
$this->registerCss("
/**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  background-color: white;
  padding: 8px 12px;
  border-radius: 4px;
  border: 1px solid transparent;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
.btn-scard {
    border: none;
    border-radius: 4px;
    outline: none;
    text-decoration: none;
    color: #fff;
    background: #32325d;
    white-space: nowrap;
    display: inline-block;
    height: 30px;
    /*line-height: 40px;*/
    padding: 0 10px;
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
    border-radius: 4px;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.025em;
    text-decoration: none;
    -webkit-transition: all 150ms ease;
    transition: all 150ms ease;
    float: left;
    margin-left: 0px;
    margin-top: 10px;
}
");
$this->registerJs("
// Create a Stripe client
var stripe = Stripe('".Yii::$app->params['stripePublishKey']."');

// Create an instance of Elements
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    lineHeight: '24px',
    fontFamily: '\"Helvetica Neue\", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});


function stripeTokenHandler(token, card) {
    
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  
  var hiddenCInput = document.createElement('input');
  hiddenCInput.setAttribute('type', 'hidden');
  hiddenCInput.setAttribute('name', 'cardId');
  hiddenCInput.setAttribute('value', card.id);
  
  form.appendChild(hiddenInput);
  form.appendChild(hiddenCInput);
  
  // Submit the form
  form.submit();
}
// Handle form submission
var form = document.getElementById('payment-form');  
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server
      stripeTokenHandler(result.token, result.token.card);
    }
  });
});
", \yii\web\View::POS_END);

$plan = Yii::$app->request->get('plan');
$affiltId = $affId = null;
?>
<!--<div class="box-header with-border">
    <h3 class="box-title">Personal Details</h3>
</div>-->
<?php /*$form = ActiveForm::begin(['class' => 'pay_payment_form', 'id' => 'payment-form']); */?>
<?= Html::beginForm(\yii\helpers\Url::current(), 'post', ['class' => 'pay_payment_form', 'id' => 'payment-form'])?>
<div class="box-body">
    <div class="col-sm-12 col-xs-12">
        <div class="panel panel-default" style="background-color: transparent;padding-top: 10px;">
            <div class="panel-header">
                <h3 class="panel-title text-center">
                    Pay Using Credit or Debit card
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>"/>
                        <div class="form-row">
                            <label for="card-element" style="display: block;">

                            </label>
                            <div id="card-element">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors -->
                            <div id="card-errors" class="text-red" role="alert"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-footer">
    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary pull-right', 'title' => 'Continue']); ?>
    <?= Html::a('Previous', ['get-plan', 'affiltId' => $affiltId, 'affId' => $affId, 'plan' => $plan, 'step' => 1], ['class' => 'btn btn-default pull-right', 'title' => 'Previous', 'style' => 'margin-right:10px']); ?>
</div>
<?= Html::endForm(); ?>
<?php /*ActiveForm::end(); */?>