<?php

namespace app\controllers;

use app\components\GetApiData;
use app\components\SendMail;
use app\models\AdjustmentInventoryReport;
use app\models\Affiliates;
use app\models\AllProductListing;
use app\models\Blog;
use app\models\BlogSearch;
use app\models\CustomizedServicesUser;
use app\models\FbaAllListingData;
use app\models\FbaAllListingDataSearch;
use app\models\NotificationSetting;
use app\models\ProductOffers;
use app\models\ReimbursementsReport;
use app\models\RepriserRule;
use app\models\SiteSetting;
use app\models\User;
use MCS\MWSClient;
use Stripe\Customer;
use Stripe\Stripe;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    public $defaultAction = 'login';

    public $enableCsrfValidation = false;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /*public function actionHome()
    {
        $this->layout = 'home-layout';
        return $this->render('home');
    }*/

    public function actionTermsOfUse()
    {
        $this->layout = 'home-layout';
        return $this->render('terms-of-use');
    }

    public function actionGetPlan($affiltId=null, $affId=null, $plan=null, $step=1)
    {
        $model = new User();
        $this->layout = 'home-layout';
        $model->scenario = 'create';
        Stripe::setApiKey(Yii::$app->params['stripeApiKey']);

        $pAmt = Yii::$app->request->get('price');
        $diCode = Yii::$app->request->get('discount');

        if($pAmt && $diCode)
            Yii::$app->data->getDiscountedPrice($pAmt, $diCode);

        if(($s = Yii::$app->session->get('step-first')) !== null){
            $model = $s;
        }

        if(($s = Yii::$app->session->get('step-second')) !== null){
            $model = $s;
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($plan == 'free') {
            if ($model->load(Yii::$app->request->post())) {
                $model->u_type = 2;
                $model->u_password = MD5($model->u_password);
                $model->u_sub_plan = 'free';
                $model->u_status = 1; //disabled
                if($model->save(false)) {
                    Yii::$app->session->remove('step-first');
                    Yii::$app->session->setFlash('success', 'You have successfully registered with us. Before login you need to active your account by verifying your email. Please check your inbox.');
                    return $this->redirect(['/site/login']);
                }
            }
        }

        if ($model->load(Yii::$app->request->post()) && $step == 1) {
            Yii::$app->session->set('step-first', $model);
            return $this->redirect(['get-plan', 'affiltId' => $affiltId, 'affId' => $affId, 'plan' => $plan, 'step' => 2]);
        }

        if (Yii::$app->request->post() && $step == 2) {
            $modelOne = Yii::$app->session->get('step-first');
            $isDefault = Yii::$app->request->post('set-default');
            $token = Yii::$app->request->post('stripeToken');
            $plan = 'test-basic-monthly';
            $result = null;

            if($modelOne) {
                try {
                    if (empty($token))
                        throw new Exception("The Stripe Token was not generated correctly");

                    $customer = Customer::create(array(
                        "email" => $modelOne->u_email,
                        "source" => $token
                    ));

                    if (!empty($discount)) {
                        try {
                            //\Stripe\Coupon::retrieve($discountID);
                            $response = \Stripe\Coupon::retrieve($discount);
                            $responseArray = $response->__toArray(true);

                            if ($responseArray['valid']) {
                                $sub = \Stripe\Subscription::create(array(
                                    "customer" => $customer->id,
                                    "plan" => $plan, //"test-basic-monthly",
                                    "coupon" => $discount,
                                ));
                            } else {
                                $sub = \Stripe\Subscription::create(array(
                                    "customer" => $customer->id,
                                    "plan" => $plan, //"test-basic-monthly",
                                ));
                            }
                            $result = $customer;
                            //echo "successfully payment..<br>";
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }
                    } else {
                        \Stripe\Subscription::create(array(
                            "customer" => $customer->id,
                            "plan" => $plan, //"test-basic-monthly",
                        ));
                        $result = $customer;
                        // echo "successfully payment..<br>";
                    }

                    if ($result) {
                        if ($model) {
                            $model->u_cust_id = $result->id;
                            $model->u_address = '';
                            $model->u_city = '';
                            $model->u_country = '';
                            $model->u_card_last_no = $result->sources->data[0]->last4;
                            $model->u_type = 2;
                            $model->u_sub_plan = $plan;
                            $model->u_payment = 1;
                            $model->u_contact_no = $modelOne->u_contact_no;
                            $model->u_name = $modelOne->u_name;
                            $model->u_password = MD5($modelOne->u_password);
                            // $model->u_password = 'temp';
                            $model->u_status = 1; //disabled
                            if ($model->save(false)) {
                                $id = \Yii::$app->security->encryptByKey($model->u_id, \Yii::$app->request->cookieValidationKey);

                                Yii::$app->session->setFlash('success', 'You have register with us successfully. Please check your mail inbox for account activation');
                                $subject = "[QikBulk]: Your QikBulk account created. you need to active account";
                                $activeLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/active-user', 'token' => $id]);
                                $content = ['userName' => $model->u_name, 'activeLink' => $activeLink];
                                $promotionName = "Sign Up Template";

                                /*try {
                                    $status = SendMail::sendSupportMail($model->u_email, $model->u_name, $subject, $content, $promotionName);
                                    if (!$status) {
                                        Yii::$app->session->setFlash('multiLoginError', 'Sorry, we are unable to send email to you.');
                                    }
                                } catch (\Exception $e) {
                                    Yii::$app->session->setFlash('multiLoginError', 'Sorry, we are unable to send email to you.');
                                }*/

                                /*$promoName = "New User Create";
                                $subjectAdmin = "[QikBulk]: New User Sign up";
                                $contentAdmin = ['message' => "New User, " . $model->u_name . " is sign up on QikBulk.", 'userName' => 'Quincy Lin'];
                                SendMail::sendSupportMail("gatedlist@gmail.com", "Quincy Lin", $subjectAdmin, $contentAdmin, $promoName);*/

                                Yii::$app->session->remove('step-first');
                                return $this->redirect(['/site/login']);
                                //return $this->redirect(['set-password', 'id' => $id, 'billAmt' => $billAmt, 'orderNo' => $custId, 'affiltId' => '', 'affId' => '']);
                            }
                        }
                    }
                    $success = 'Your Card saved successful.';
                } catch (\Stripe\Error\Card $e) {
                    Yii::$app->session->setFlash('custStatus', 'Something went wrong for Card.');
                } catch (\Stripe\Error\InvalidRequest $e) {
                    Yii::$app->session->setFlash('custStatus', 'Something went wrong for Invalid Request.');
                } catch (\Stripe\Error\Authentication $e) {
                    Yii::$app->session->setFlash('custStatus', 'Something went wrong for Authentication.');
                } catch (\Stripe\Error\ApiConnection $e) {
                    Yii::$app->session->setFlash('custStatus', 'Something went wrong for API Connection.');
                } catch (\Stripe\Error\Base $e) {
                    Yii::$app->session->setFlash('custStatus', 'Something went wrong for Base Error.');
                } catch (Exception $e) {
                    Yii::$app->session->setFlash('custStatus', 'Something went wrong.');
                }
            }
            //Yii::$app->session->setFlash('success', 'You have successfully registered with us. Before login you need to active your account by verifying your email. Please check your inbox.');
        }

        if($plan == 'free') {
            return $this->render('free_plan_form', ['affId' => $affId, 'model' => $model, 'plan' => $plan, 'step' => $step]);
        } else {
            return $this->render('signup_plan_form', ['affId' => $affId, 'model' => $model, 'plan' => $plan, 'step' => $step]);
        }

    }

    public function actionCheckCoupon($coupon, $price, $validPlan=null)
    {
        Stripe::setApiKey(Yii::$app->params['stripeApiKey']);
        $couponModel = null; //Coupons::findOne(['c_code' => $coupon]);
        $planBtn = '
                    <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="'.Yii::$app->params['stripePublishKey'].'"
                        data-amount="'.$price.'00"
                        data-name="QikBulk"
                        data-description="Monthly Subscription"
                        data-image="'.Yii::getAlias("@web").'/images/logostripe.png"
                        data-shipping-address="true"
                        data-billing-address="true"
                        data-label="Sign Up"
                        id="'.$price.'PlanDiscount-btn">
                ';
        try {

            if($couponModel && ($validPlan && ($couponModel->c_plan != $validPlan)))
            {
                $planBtn = '
                    <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="'.Yii::$app->params['stripePublishKey'].'"
                        data-amount="'.$price.'00"
                        data-name="QikBulk"
                        data-description="Monthly Subscription"
                        data-image="'.Yii::getAlias("@web").'/images/logostripe.png"
                        data-shipping-address="true"
                        data-billing-address="true"
                        data-label="Sign Up"
                        id="'.$price.'PlanDiscount-btn">
                ';

                $result = ['status' => false, 'msg' => '<span class="text-danger">'.$coupon.' is not for this plan. Please enter valid coupon code.</span>', 'planAmount' => false, 'planBtn' => $planBtn];

                return json_encode($result);
            }

            $response = \Stripe\Coupon::retrieve($coupon);
            $responseArray = $response->__toArray(true);
            $discountPrice = $msg = null;
            //print_r($responseArray);
            if($responseArray['valid'] && $price)
            {
                if($responseArray['amount_off'])
                {
                    $discount = $responseArray['amount_off']/100;
                    $discountPrice = ($price - $discount)*100;
                    $msg = "Congratulations, $ ".$discount." off coupon applied successfully!";
                }
                else if($responseArray['percent_off']) {
                    $discount = ($price * $responseArray['percent_off'])/100;
                    $discountPrice = ($price - $discount)*100;
                    $msg = "Congratulations, ".$responseArray['percent_off']."% discount coupon applied successfully!";
                }

                $planBtn = '
                    <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="'.Yii::$app->params['stripePublishKey'].'"
                        data-amount="'.$discountPrice.'"
                        data-name="QikBulk"
                        data-description="Monthly Subscription"
                        data-image="'.Yii::getAlias("@web").'/images/logostripe.png"
                        data-shipping-address="true"
                        data-billing-address="true"
                        data-label="Sign Up"
                        id="'.$price.'PlanDiscount-btn">
                ';

                $result = ['status' => true, 'msg' => '<span class="text-success">'.$msg.'</span>', 'planAmount' => $discountPrice, 'planBtn' => $planBtn];
            }
            else {
                $planBtn = '
                    <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="'.Yii::$app->params['stripePublishKey'].'"
                        data-amount="'.$price.'00"
                        data-name="QikBulk"
                        data-description="Monthly Subscription"
                        data-image="'.Yii::getAlias("@web").'/images/logostripe.png"
                        data-shipping-address="true"
                        data-billing-address="true"
                        data-label="Sign Up"
                        id="'.$price.'PlanDiscount-btn">
                ';
                $result = ['status' => false, 'msg' => '<span class="text-danger">Coupon code is invalid.</span>', 'planAmount' => false, 'planBtn' => $planBtn];
            }
        } catch (\Stripe\Error\InvalidRequest $e)
        {
            // echo "Invalid Coupon code.";
            $result = ['status' => false, 'msg' => '<span class="text-danger">Coupon code is invalid.</span>', 'planAmount' => false, 'planBtn' => $planBtn];
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            //echo "Authentication with Stripe's API failed";
            $result = ['status' => false, 'msg' => '<span class="text-danger">Authentication with Stripe\'s API failed.</span>', 'planAmount' => false, 'planBtn' => $planBtn];
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            //echo "Network communication with Stripe failed";
            $result = ['status' => false, 'msg' => '<span class="text-danger">Network communication with Stripe failed.</span>', 'planAmount' => false, 'planBtn' => $planBtn];
        } catch (\Stripe\Error\Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            //echo "Something went wrong.";
            $result = ['status' => false, 'msg' => '<span class="text-danger">Something went wrong.</span>', 'planAmount' => false, 'planBtn' => $planBtn];
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            //echo "Something went wrong. Please try again later.";
            $result = ['status' => false, 'msg' => '<span class="text-danger">Something went wrong. Please try again later.</span>', 'planAmount' => false, 'planBtn' => $planBtn];
        }

        return json_encode($result);
    }

    public function actionCheckout($affiltId = null, $affId=null)
    {
        $model = new User();
        Stripe::setApiKey(Yii::$app->params['stripeApiKey']);

        if(Yii::$app->request->isPost) {
            $token = Yii::$app->request->post('stripeToken');
            $email = Yii::$app->request->post('stripeEmail');
            $plan = Yii::$app->request->post('plan');
            $subcriptionID = Yii::$app->request->get('sub_id');
            $chargeID = Yii::$app->request->get('ch_id');
            $planAmount = Yii::$app->request->post('planAmount');
            $affiltId = ($affiltId) ? $affiltId : Yii::$app->request->get('affiltId');
            $affId = ($affId) ? $affId : Yii::$app->request->get('affId');

            $affCoupon = null; //Yii::$app->data->getDiscountCoupon($affId, 'QikFlips');
            $discountID = ($affiltId) ? 'AFFILIATE15OFF' : (($affCoupon) ? $affCoupon : Yii::$app->request->post('discount'));
            $result = null;

            try {
                $customer = Customer::create(array(
                    "email" => $email,
                    "source" => $token
                ));

                if (!empty($discountID)) {
                    try {
                        //\Stripe\Coupon::retrieve($discountID);
                        $response = \Stripe\Coupon::retrieve($discountID);
                        $responseArray = $response->__toArray(true);

                        if($responseArray['valid']) {
                            $sub = \Stripe\Subscription::create(array(
                                "customer" => $customer->id,
                                "plan" => $plan, //"test-basic-monthly",
                                "coupon" => $discountID,
                            ));
                        }
                        else {
                            $sub = \Stripe\Subscription::create(array(
                                "customer" => $customer->id,
                                "plan" => $plan, //"test-basic-monthly",
                            ));
                        }
                        $result = $customer;
                        //echo "successfully payment..<br>";
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }
                } else {
                    \Stripe\Subscription::create(array(
                        "customer" => $customer->id,
                        "plan" => $plan, //"test-basic-monthly",
                    ));
                    $result = $customer;
                    // echo "successfully payment..<br>";
                }

                if($result) {
                    $userModel = User::findOne(['u_email' => $result->email]);
                    //$userCustomer = new UserCustomerLog();

                    if($userModel){
                        /*$userCustomer->ucl_cust_id = $userModel->u_cust_id;
                        $userCustomer->ucl_user_id = $userModel->u_id;
                        $userCustomer->save(false);*/

                        $userModel->u_cust_id = $result->id;
                        $userModel->u_email = $result->email;
                        $userModel->u_name = $result->sources->data[0]->name;
                        $userModel->u_address = $result->sources->data[0]->address_line1.' '.$result->sources->data[0]->address_zip;
                        $userModel->u_city = $result->sources->data[0]->address_city;
                        $userModel->u_country = $result->sources->data[0]->address_country;
                        $userModel->u_card_last_no = $result->sources->data[0]->last4;
                        $userModel->u_type = 2;
                        $userModel->u_contact_no = 00;
                        $userModel->u_password = 'temp';
                        if($userModel->save(false)){
                            $defaultCode = SiteSetting::find()->one();
                            $modelAf = new Affiliates();
                            $modelAf->a_user_id = $model->u_id;
                            $modelAf->a_affiliate_coupon = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', "", $model->u_name), 0, 4))."0".$model->u_id;
                            $modelAf->a_allocated_stripe_coupon = ($defaultCode) ? $defaultCode->ss_default_coupon_code : null;
                            $modelAf->a_payout_percentage = ($defaultCode) ? $defaultCode->ss_payout_percentage : null;
                            $modelAf->a_status = 1;
                            $modelAf->save(false);

                            $custId = \Yii::$app->security->encryptByKey($userModel->u_cust_id, \Yii::$app->request->cookieValidationKey);
                            $billAmt = \Yii::$app->security->encryptByKey($planAmount, \Yii::$app->request->cookieValidationKey);
                            $id = \Yii::$app->security->encryptByKey($userModel->u_id, \Yii::$app->request->cookieValidationKey);
                            $affiltId = \Yii::$app->security->encryptByKey($affiltId, \Yii::$app->request->cookieValidationKey);
                            $affId = \Yii::$app->security->encryptByKey($affId, \Yii::$app->request->cookieValidationKey);
                            return $this->redirect(['set-password', 'id' => $id, 'billAmt' => $billAmt, 'orderNo' => $custId, 'affiltId' => $affiltId, 'affId' => $affId]);
                        }
                    }
                    else {
                        $model->u_cust_id = $result->id;
                        $model->u_email = $result->email;
                        $model->u_name = $result->sources->data[0]->name;
                        $model->u_address = $result->sources->data[0]->address_line1.' '.$result->sources->data[0]->address_zip;
                        $model->u_city = $result->sources->data[0]->address_city;
                        $model->u_country = $result->sources->data[0]->address_country;
                        $model->u_card_last_no = $result->sources->data[0]->last4;
                        $model->u_type = 2;
                        $model->u_contact_no = 00;
                        $model->u_password = 'temp';
                        if($model->save(false)) {
                            $defaultCode = SiteSetting::find()->one();
                            $modelAf = new Affiliates();
                            $modelAf->a_user_id = $model->u_id;
                            $modelAf->a_affiliate_coupon = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', "", $model->u_name), 0, 4))."0".$model->u_id;
                            $modelAf->a_allocated_stripe_coupon = ($defaultCode) ? $defaultCode->ss_default_coupon_code : null;
                            $modelAf->a_payout_percentage = ($defaultCode) ? $defaultCode->ss_payout_percentage : null;
                            $modelAf->a_status = 1;
                            $modelAf->save(false);

                            $custId = \Yii::$app->security->encryptByKey($model->u_cust_id, \Yii::$app->request->cookieValidationKey);
                            $billAmt = \Yii::$app->security->encryptByKey($planAmount, \Yii::$app->request->cookieValidationKey);
                            $id = \Yii::$app->security->encryptByKey($model->u_id, \Yii::$app->request->cookieValidationKey);
                            $affiltId = \Yii::$app->security->encryptByKey($affiltId, \Yii::$app->request->cookieValidationKey);
                            $affId = \Yii::$app->security->encryptByKey($affId, \Yii::$app->request->cookieValidationKey);
                            return $this->redirect(['set-password', 'id' => $id, 'billAmt' => $billAmt, 'orderNo' => $custId, 'affiltId' => $affiltId, 'affId' => $affId]);
                        }
                    }
                }
            } catch (\Stripe\Error\Card $e) {
                Yii::$app->session->setFlash('custStatus', 'Something went wrong.');
                return $this->redirect(['/site/home']);
            } catch (\Stripe\Error\InvalidRequest $e) {
                // Invalid parameters were supplied to Stripe's API
                Yii::$app->session->setFlash('custStatus', 'Something went wrong.');
                return $this->redirect(['/site/home']);
            } catch (\Stripe\Error\Authentication $e) {
                // Authentication with Stripe's API failed
                Yii::$app->session->setFlash('custStatus', 'Something went wrong.');
                return $this->redirect(['/site/home']);
            } catch (\Stripe\Error\ApiConnection $e) {
                // Network communication with Stripe failed
                Yii::$app->session->setFlash('custStatus', 'Something went wrong.');
                return $this->redirect(['/site/home']);
            } catch (\Stripe\Error\Base $e) {
                // Display a very generic error to the user, and maybe send
                // yourself an email
                Yii::$app->session->setFlash('custStatus', 'Something went wrong.');
                return $this->redirect(['/site/home']);
            } catch (Exception $e) {
                // Something else happened, completely unrelated to Stripe
                Yii::$app->session->setFlash('custStatus', 'Something went wrong.');
                return $this->redirect(['/site/home']);
            }
        }
    }

    public function actionSetPassword($id, $billAmt=null, $orderNo=null, $affiltId=null, $affId=null)
    {
        $id = \Yii::$app->security->decryptByKey($id, \Yii::$app->request->cookieValidationKey);
        $billAmt = \Yii::$app->security->decryptByKey($billAmt, \Yii::$app->request->cookieValidationKey);
        $orderNo = \Yii::$app->security->decryptByKey($orderNo, \Yii::$app->request->cookieValidationKey);
        $affiltId = \Yii::$app->security->decryptByKey($affiltId, \Yii::$app->request->cookieValidationKey);
        $affId = \Yii::$app->security->decryptByKey($affId, \Yii::$app->request->cookieValidationKey);
        $model = User::findOne(['u_id' => $id]);

        if($model->load(Yii::$app->request->post()))
        {
            $username = $orderNo;  //\Yii::$app->data->generatePassword(8);
            $password = \Yii::$app->data->generatePassword(8);
            /*$username = explode('@', $model->u_email);
            $username = (strlen($username[0]) < 4) ? $username[0].\Yii::$app->data->generatePassword(4) : $username[0];*/
            $model->u_aff_username = $username;
            $model->u_aff_password = $password;
            // utf8_encode(\Yii::$app->security->encryptByKey($password, \Yii::$app->request->cookieValidationKey))
            // for view plain password :
            //  Yii::$app->security->decryptByKey(utf8_decode($model->u_aff_password), \Yii::$app->request->cookieValidationKey);

            $model->u_password = md5($model->u_password);

            if($affiltId || $affId) // for refer user
                $model->u_refer_date = date('Y-m-d');

            if($model->save(false))
            {
                return $this->redirect(['/site/login']);
            }
        }
        return $this->renderAjax('set-password-form', ['model' => $model, 'billAmt' => $billAmt, 'orderNo' => $orderNo, 'affltId' => $affiltId]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        return $this->render('index');
    }

    public function actionGetProductNo()
    {
        $count = null;
        if(Yii::$app->request->post()) {
            $data = Yii::$app->data->getNoOfProduct(Yii::$app->request->post('url'));
            $count = ($data) ? $data : 0;
        }
        return $this->render('product-no', ['count' => $count]);
    }

    public function actionBlog()
    {
        $this->layout = 'home-layout';

        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('blog-list', ['dataProvider' => $dataProvider]);
    }

    public function actionBlogSingle($slug)
    {
        $this->layout = 'home-layout';
        $model = Blog::findOne(['slug' => $slug]);

        if (empty($model)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('blog-single', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/site/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //if(Yii::$app->user->identity->u_type == 2)
            //{
                return $this->redirect(['/site/index']);
            //}
            //return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionAddToList($id, $type, $linkId=null)
    {
        $todayDeal = $idUArray = $idUArrayTemp = $idCArrayTemp = $storedUListArray = $clearanceDeal = $storedCListArray = $storedTListArray = $idTArray = $idCArray = $linkIdArray = [];
        $status = null;

        if($type == 'clearanceDeal') {
            $idCArray = Json::decode($id);

            foreach ($idCArray as $val) {
                $idCArrayTemp[$val] = $val;
            }
            $idCArray = $idCArrayTemp;

            if(Yii::$app->session->get('uWishList')) {
                $storedListJson = Yii::$app->session->get('uWishList');
                $storedCListArray = Json::decode($storedListJson);
            }
            if($storedCListArray) {
                $idTArray = $storedCListArray['todayDeal'];
                $linkIdArray = $storedCListArray['linkIdArray'];
                $idUArray = $storedCListArray['userDataDeal'];

                if($storedCListArray['clearanceDeal']) {
                    $idCArray = array_unique(array_merge($storedCListArray['clearanceDeal'], $idCArray));
                }
            }

            /*if(Yii::$app->session->get('uWishList')) {
                $storedListJson = Yii::$app->session->get('uWishList');
                $storedCListArray = Json::decode($storedListJson);
            }
            $idCArray = [$id];
            if($storedCListArray) {
                $key = array_search($id, $storedCListArray['clearanceDeal']);
                $idTArray = $storedCListArray['todayDeal'];
                if($key !== false){
                    unset($storedCListArray['clearanceDeal'][$key]);
                    $idCArray = $storedCListArray['clearanceDeal'];
                    $status = 'R';
                }
                else {
                    $idCArray = array_merge($storedCListArray['clearanceDeal'], $idCArray);
                    $status = 'A';
                }
            }*/
        }

        if($type == 'todayDeal') {
            $idTArray = Json::decode($id);
            $linkIdArray = Json::decode($linkId);

            $idTArrayTemp = $linkIdArrayTemp = [];
            foreach ($idTArray as $val) {
                $idTArrayTemp[$val] = $val;
            }
            $idTArray = $idTArrayTemp;

            foreach ($linkIdArray as $val) {
                $linkIdArrayTemp[$val] = $val;
            }
            $linkIdArray = $linkIdArrayTemp;

            if(Yii::$app->session->get('uWishList')) {
                $storedListJson = Yii::$app->session->get('uWishList');
                $storedTListArray = Json::decode($storedListJson);
            }
            if($storedTListArray) {
                $idCArray = $storedTListArray['clearanceDeal'];
                $idUArray = $storedTListArray['userDataDeal'];
                //$linkIdArray = $storedTListArray['linkIdArray'];
                if($storedTListArray['todayDeal']) {
                    $idTArray = array_unique(array_merge($storedTListArray['todayDeal'], $idTArray));
                }
                if($storedTListArray['linkIdArray']) {
                    $linkIdArray = array_unique(array_merge($storedTListArray['linkIdArray'], $linkIdArray));
                }
            }

            /*if(Yii::$app->session->get('uWishList')) {
                $storedListJson = Yii::$app->session->get('uWishList');
                $storedTListArray = Json::decode($storedListJson);
            }
            $idTArray = [$id];
            if($storedTListArray) {
                $key = array_search($id, $storedTListArray['todayDeal']);
                $idCArray = $storedTListArray['clearanceDeal'];
                if($key !== false){
                    unset($storedTListArray['todayDeal'][$key]);
                    $idTArray = $storedTListArray['todayDeal'];
                    $status = 'R';
                }
                else {
                    $idTArray = array_merge($storedTListArray['todayDeal'], $idTArray);
                    $status = 'A';
                }
            }*/
        }

        if($type == 'userDataDeal') {
            $idUArray = Json::decode($id);

            foreach ($idUArray as $val) {
                $idUArrayTemp[$val] = $val;
            }
            $idUArray = $idUArrayTemp;

            if(Yii::$app->session->get('uWishList')) {
                $storedListJson = Yii::$app->session->get('uWishList');
                $storedUListArray = Json::decode($storedListJson);
            }
            if($storedUListArray) {
                $idTArray = $storedUListArray['todayDeal'];
                $idCArray = $storedUListArray['clearanceDeal'];
                $linkIdArray = $storedUListArray['linkIdArray'];
                if($storedUListArray['userDataDeal']) {
                    $idUArray = array_unique(array_merge($storedUListArray['userDataDeal'], $idUArray));
                }
            }
        }

        //if($idCArray || $idTArray) {
        $userWishList = ['todayDeal' => $idTArray, 'clearanceDeal' => $idCArray, 'linkIdArray' => $linkIdArray, 'userDataDeal' => $idUArray];
        $count = (empty($idTArray) && empty($idCArray) && empty($idUArray)) ? 0 : (count($linkIdArray) + count($idCArray) + count($idUArray));
        $userWishListJson = Json::encode($userWishList);

        if($count <= 400) {
            Yii::$app->session->set('uWishListButton', '');
            Yii::$app->session->set('uWishList', $userWishListJson);
            Yii::$app->session->set('uWishListCount', $count);
            $msg = 'Row Saved in Wish List successfully..';
        }
        else {
            $status = 'full';
            Yii::$app->session->set('uWishListButton', 'disabled');
            $msg = 'You have reached max limit of wish list';
        }

        //$msg = ($status == 'A') ? 'Row added to Wish List successfully...' : 'Row removed from Wish List successfully...';

        if(empty($idCArray) && empty($idTArray) && empty($idUArray)) {
            Yii::$app->session->remove('uWishList');
            Yii::$app->session->remove('uWishListCount');
            Yii::$app->session->remove('uWishListButton');
        }

        $result = ['msg' => $msg, 'count' => $count, 'status' => $status];

        return Json::encode($result);
    }

    /**
     * Custom Service requested by User using Price plan Contact us form
     * @return array|string|\yii\web\Response
     */
    public function actionCustomServices()
    {
        $model = new CustomizedServicesUser();
        $model->scenario = 'request-service';

        Stripe::setApiKey(Yii::$app->params['stripeApiKey']);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post())) {
            $model->csu_services = implode("_", $model->csu_services);
            $model->csu_audio_file = Yii::$app->request->post('voice-file-name');

            $customer = \Stripe\Customer::create(array(
                "email" => $model->csu_email,
                "description" => "Custom service charge for ".$model->csu_email,
            ));

            $model->csu_cust_id = $customer->id;
            $model->csu_date = date('Y-m-d');
            if($model->save(false)) {
                $content = ['userName' => $model->csu_first_name];
                $subject = '[Account-Dr] Thank you for contacting for Customized services plan';
                $promotionName = 'User Acknowledgement';
                $mailStatus = SendMail::sendSupportMail($model->csu_email, $model->csu_first_name, $subject, $content, $promotionName);
                if($mailStatus) {
                    Yii::$app->session->setFlash('success', 'Thank you for contacting for Customized services plan. After reviewing your needs we will contact you.');
                } else {
                    Yii::$app->session->setFlash('error', 'Mail not sent. Please contact admin');
                }

                $adminNotifyData = NotificationSetting::find()->all();
                if($adminNotifyData) {
                    foreach ($adminNotifyData as $and) {
                        if($and->ns_email) {
                            $contentA = ['customerEmail' => $model->csu_email];
                            $subjectA = '[Account-Dr] Request for customized services plan';
                            $promotionNameA = 'Admin Notification';
                            SendMail::sendSupportMail($and->ns_email, 'Admin', $subjectA, $contentA, $promotionNameA);
                        }
                    }
                }
            } else {
                Yii::$app->session->setFlash('error', 'Something went wrong..');
            }
            return $this->redirect(['/', 'status' => 'success']);
        }
        return $this->renderAjax('custom-services-modal', ['model' => $model]);
    }

    public function actionSaveVoice()
    {
        if (isset($_FILES["audio-blob"])) {
            $fileName = $_POST["audio-filename"].'.wav';
            $uploadDirectory = Yii::getAlias('@webroot').'/uploads/saved_audio/'.$fileName;

            if (!move_uploaded_file($_FILES["audio-blob"]["tmp_name"], $uploadDirectory)) {
                echo(" problem moving uploaded file");
            }
            return $fileName;
        }
        return false;
    }

    public function actionRepriser()
    {
        return $this->render('repriser');
    }

    public function actionSelectSku()
    {
        $searchModel = new FbaAllListingDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('select-sku-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSignUp()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $this->layout = 'main-login';
        $model = new User();
        $model->scenario = 'create';

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->u_password = md5($model->u_password);
            $model->u_type = 2;

            if($model->save(false)) {
                $id = \Yii::$app->security->encryptByKey($model->u_id, \Yii::$app->request->cookieValidationKey);
                /*$subject = "[Price Genius]: Your Price Genius account created.";
                $content = ['userName' => $model->u_name];
                $promotionName = "User Confirmation";*/

                $subjectMws = "[Price Genius]: Price Genius account created. Now, let's Connect Your Amazon Account";
                $mwsLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/set-amazon-detail', 'token' => $id]);
                $contentMws = ['userName' => $model->u_name, 'mwsLink' => $mwsLink];
                $promotionNameMws = "MWS Registration";

                /*$subjectCsv = "[Price Genius]: Upload your Cost/Min/Max";
                $csvLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/upload-cost-csv', 'id' => $id]);
                $dCsvLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/download-cost-csv']);
                $contentCsv = ['userName' => $model->u_name, 'downloadCsvLink' => $dCsvLink, 'uploadCsvLink' => $csvLink];
                $promotionNameCsv = "Min Max Cost";*/

                try {
                    //SendMail::sendSupportMail($model->u_email, $model->u_name, $subject, $content, $promotionName);
                    $status = SendMail::sendSupportMail($model->u_email, $model->u_name, $subjectMws, $contentMws, $promotionNameMws);
                    //SendMail::sendSupportMail($model->u_email, $model->u_name, $subjectCsv, $contentCsv, $promotionNameCsv);
                    if (!$status) {
                        Yii::$app->session->setFlash('error', 'Sorry, we are unable to send email to you.');
                    } else {
                        Yii::$app->session->setFlash('success', 'You have register with us successfully. Please check your inbox for further step.');
                    }
                } catch (\Exception $e) {
                    Yii::$app->session->setFlash('error', 'Sorry, we are unable to send email to you. '.$e->getMessage());
                }
                return $this->redirect(['/site/login']);
            }
        }
        return $this->render('singup', [
            'model' => $model,
        ]);
    }

    public function actionRequestMinMaxCost()
    {
        if(Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }

        $userData = User::findOne(Yii::$app->user->id);
        if ($userData) {
            $id = \Yii::$app->security->encryptByKey($userData->u_id, \Yii::$app->request->cookieValidationKey);
            $subjectCsv = "[Price Genius]: Upload your Cost/Min/Max";
            $csvLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/upload-cost-csv', 'id' => $id]);
            $dCsvLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/download-cost-csv']);
            $contentCsv = ['userName' => $userData->u_name, 'downloadCsvLink' => $dCsvLink, 'uploadCsvLink' => $csvLink];
            $promotionNameCsv = "Min Max Cost";
            $status = SendMail::sendSupportMail($userData->u_email, $userData->u_name, $subjectCsv, $contentCsv, $promotionNameCsv);
            if($status) {
                Yii::$app->session->setFlash('success', 'Email sent to register email ID. Please your inbox.');
            } else {
                Yii::$app->session->setFlash('error', 'Something went wrong');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Something went wrong. User not found.');
        }
        return $this->redirect(['/site/index']);
    }

    public function actionMagicRepricing($sku=null)
    {
        $asin = Yii::$app->request->post('asin');
        $finalPrice = 0;
        if(Yii::$app->request->post() && $asin) {
            $productOffer = Yii::$app->data->getAllOffers($asin, 'SKU');
            $yourBuyBox = Yii::$app->request->post('yourBuyBox');
            $minPrice = Yii::$app->request->post('minPrice');
            $maxPrice = Yii::$app->request->post('maxPrice');
            $rRule = Yii::$app->request->post('repriserRule');

            if($productOffer) {
                ProductOffers::deleteAll(['po_asin' => $asin]);
                foreach ($productOffer as $po) {
                    $model = new ProductOffers();
                    $model->po_asin = $asin;
                    $model->po_condition = $po['SubCondition'];
                    $model->po_seller_feedback_rating = (key_exists('SellerFeedbackRating', $po)) ? $po['SellerFeedbackRating']['SellerPositiveFeedbackRating'] : null;
                    $model->po_seller_feedback_count = (key_exists('SellerFeedbackRating', $po)) ? $po['SellerFeedbackRating']['FeedbackCount'] : null;
                    $model->po_listing_price = (key_exists('ListingPrice', $po)) ? $po['ListingPrice']['Amount'] : null;
                    $model->po_shipping_cost = (key_exists('Shipping', $po)) ? $po['Shipping']['Amount'] : null;
                    $model->po_is_amazon_fulfillment = ($po['IsFulfilledByAmazon'] == 'true') ? 1 : 0;
                    $model->po_is_buybox_winner = ($po['IsBuyBoxWinner'] == 'true') ? 1 : 0;
                    $model->po_is_featured_merchant = ($po['IsFeaturedMerchant'] == 'true') ? 1 : 0;
                    $model->save(false);
                }

                $rRuleData = RepriserRule::findOne($rRule);
                if($rRuleData) {
                    $isAmazonIgnore = $rRuleData->rr_rule_comparison_ignore_amazon;

                    if($rRuleData->rr_goal == 'bbp') {
                        $comPriceD = ProductOffers::find()->select(['po_listing_price'])->andWhere(['po_asin' => $asin, 'po_is_buybox_winner' => 1])->one();
                        $comPrice = ($comPriceD) ? $comPriceD->po_listing_price : 0;
                        //->andFilterWhere(['po_is_amazon_fulfillment' => $isAmazonIgnore])
                    } else {
                        $comPrice = ProductOffers::find()->andWhere(['po_asin' => $asin])->min('po_listing_price');
                        //->andFilterWhere(['po_is_amazon_fulfillment' => $isAmazonIgnore])
                    }

                    $comPrice = round($comPrice, 2);
                    $spPrice = $rRuleData->rr_pricing_amount;
                    $spPercent = $rRuleData->rr_pricing_percentage;
                    $tempPrice = 0;

                    if($rRuleData->rr_match_action == 1) {
                        if($spPercent) {
                            $bAmount = ($comPrice*$spPercent)/100;
                            $tempPrice = $comPrice - $bAmount;
                        }
                        if($spPrice) {
                            $tempPrice = $comPrice - $spPrice;
                        }
                    } elseif($rRuleData->rr_match_action == 3) {
                        if($spPercent) {
                            $bAmount = ($comPrice*$spPercent)/100;
                            $tempPrice = $comPrice + $bAmount;
                        }
                        if($spPrice) {
                            $tempPrice = $comPrice + $spPrice;
                        }
                    } else {
                        $tempPrice = $comPrice;
                    }


                    if($tempPrice) {
                        if($tempPrice <= $maxPrice && $tempPrice >= $minPrice) {
                            $finalPrice = $tempPrice;
                        } else {
                            $finalPrice = $yourBuyBox;
                        }
                        /*elseif ($tempPrice <= $yourBuyBox) {
                            $finalPrice = $yourBuyBox;
                        } else {
                            $finalPrice = $maxPrice;
                        }*/
                    } else {
                        $finalPrice = $yourBuyBox;
                    }


                    if($sku) {
                        $skuData = FbaAllListingData::find()->andWhere(['seller_sku' => $sku])->exists();
                        if($skuData) {
                            FbaAllListingData::updateAll(['repricing_min_price' => $minPrice, 'repricing_max_price' => $maxPrice, 'repricing_rule_id' => $rRule, 'repricing_cost_price' => $finalPrice], ['seller_sku' => $sku]);

                            Yii::$app->session->setFlash('success', 'Rule added.');

                            return $this->redirect(['/fba-all-listing-data/index']);
                        }
                    }
                }
            }
        }

        return $this->render('magic-repricing', ['finalPrice' => $finalPrice]);
    }

    public function actionSetAmazonDetail($token=null)
    {
        if($token) {
            $id = \Yii::$app->security->decryptByKey($token, \Yii::$app->request->cookieValidationKey);
        } else {
            $id = Yii::$app->user->id;
        }

        $model = User::findOne($id);

        if($model->load(Yii::$app->request->post()))
        {
            $client = new MWSClient([
                'Marketplace_Id' => 'ATVPDKIKX0DER',
                'Seller_Id' => $model->u_mws_seller_id,
                'Access_Key_ID' => 'AKIAJISZVSHK3CD7H27A',
                'Secret_Access_Key' => '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',
                'MWSAuthToken' => $model->u_mws_auth_token // Optional. Only use this key if you are a third party user/developer
            ]);

            // Optionally check if the supplied credentials are valid
            if ($client->validateCredentials()) {
                // Credentials are valid
                if($model->save(false)) {
                    \Yii::$app->consoleRunner->run("hello/all-active-listing ".$model->u_id);
                }

                return $this->redirect(['/site/thank-you']);
            } else {
                // Credentials are not valid
                $model->addErrors(['u_mws_seller_id' => 'Your Seller ID or MWS Auth Token is Wrong.', 'u_mws_auth_token' => 'Your Seller ID or MWS Auth Token is Wrong.']);
            }
        }
        return $this->renderAjax('set-amazon-details', ['model' => $model]);
    }

    public function actionThankYou()
    {
        $this->layout = 'main-login';
        return $this->render('thank-you-view');
    }

    public function actionDownloadCostCsv()
    {
        $csvFile = Yii::getAlias('@webroot').'/uploads/csv_template/min_max_cost.csv';

        if (file_exists($csvFile)) {
            return Yii::$app->response->sendFile($csvFile);
        } else {
            Yii::$app->session->setFlash('error', 'File not found.');
        }

        return $this->redirect(['/site/login']);
    }

    public function actionUploadCostCsv($id)
    {
        $id = \Yii::$app->security->decryptByKey($id, \Yii::$app->request->cookieValidationKey);
        $model = User::findOne($id);

        if($model->load(Yii::$app->request->post())) {
            $model->csv_file = UploadedFile::getInstance($model, 'csv_file');
            $uploadedFile = $model->saveImportFile();
            $model->save(false);
            $objPHPExcel = \PHPExcel_IOFactory::load($model->importFilePath.$model->csv_file);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

            unset($sheetData[1]);

            foreach($sheetData as $k => $line)
            {
                if(!array_filter($line))
                    continue;

                $line = array_map('trim', $line);
                $line = array_map(function($value) { return empty($value) ? NULL : $value; }, $line);

                $cModel = FbaAllListingData::find()->andWhere(['seller_sku' => $line['A']])->all();
                if($cModel) {
                    foreach ($cModel as $model) {
                        $model->buy_cost = ($line['D'] > $line['B']) ? $line['D'] : (($line['E'] < $line['B']) ? $line['E'] : $line['B']);
                        $model->repricing_min_price = $line['D'];
                        $model->repricing_max_price = $line['E'];
                        $model->save(false);
                    }
                }
            }
            Yii::$app->session->setFlash('success', 'Data has been imported successfully.');

            return $this->redirect(['login']);
        }

        return $this->renderAjax('upload-csv-form', ['model' => $model]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->remove('uWishList');
        Yii::$app->session->remove('uWishListCount');

        return $this->goHome();
    }

    public function actionResetWishList($ref = null)
    {
        Yii::$app->session->remove('uWishList');
        Yii::$app->session->remove('uWishListCount');
        Yii::$app->session->remove('uWishListButton');

        if($ref == 'todayDeal') {
            return $this->redirect(['/today-deals/index']);
        } elseif($ref == 'clearanceDeal') {
            return $this->redirect(['/clearance-data/index']);
        } elseif($ref == 'userDataDeal') {
            return $this->redirect(['/user-data/index']);
        } else {
            return $this->redirect(['/user/user-wish-list']);
        }
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSwitchBack()
    {
        $originalId = Yii::$app->session->get('user.idbeforeswitch');
        if(empty($originalId)) {
            throw new \yii\web\HttpException(401, 'You are not allowed to perform this action.');
        }
        if ($originalId) {
            $user = User::findOne($originalId);
            $duration = 0;
            Yii::$app->user->switchIdentity($user, $duration);
            Yii::$app->session->remove('user.idbeforeswitch');
            return $this->redirect(['/site/index']);
        }
        return $this->redirect(['/']);
    }
}
