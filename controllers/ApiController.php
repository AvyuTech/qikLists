<?php

namespace app\controllers;

use app\components\GetApiData;
use app\components\SendMail;
use app\models\AdjustmentInventoryReport;
use app\models\Affiliates;
use app\models\AllOrdesList;
use app\models\AllProductListing;
use app\models\AppliedRepriserRule;
use app\models\Blog;
use app\models\BlogSearch;
use app\models\CustomizedServicesUser;
use app\models\FbaAllListingData;
use app\models\FbaAllListingDataSearch;
use app\models\ItemFeeListData;
use app\models\NotificationSetting;
use app\models\OrderItemsAsin;
use app\models\PasswordResetRequestForm;
use app\models\ProductOffers;
use app\models\ReimbursementsReport;
use app\models\RepriserRule;
use app\models\ResetPasswordForm;
use app\models\SiteSetting;
use app\models\User;
use Stripe\Customer;
use Stripe\Stripe;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;

class ApiController extends Controller
{
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

    /**
     * Login API
     * @param $value
     * @return mixed|string
     */
    public function actionUserLogin()
    {
        $result = [];
        $username = (Yii::$app->request->post('username')) ? Yii::$app->request->post('username') : Yii::$app->request->post('email');
        $password = Yii::$app->request->post('password');
        $secretKey = Yii::$app->request->post('secretKey');
        $deviceToken = Yii::$app->request->post('device_token');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $isMWSExist = false;

        if($validSecretKey && $secretKey == $validSecretKey) {
            if($username && $password) {
                $model = User::findOne(['u_email' => $username, 'u_password' => $password]);
                if($model) {
                    $model->device_token = $deviceToken;
                    $model->save(false);

                    $uData = [
                        'uName' => $model->u_name,
                        'uEmail' => $model->u_email,
                        'userId' => $model->u_id,
                        'stripeEphemeralKey' => Json::decode($model->u_stripe_ephemeral_key),
                    ];
                    $isMWSExist = ($model->u_mws_seller_id) ? true : false;
                    $result = [
                        'message' => 'Login Successfully.',
                        'isMWSExist' => $isMWSExist,
                        'data' => $uData,
                        'status' => true
                    ];
                } else {
                    $result = ['message' => 'User not found/Invalid username or password.', 'isMWSExist' => $isMWSExist, 'status' => false];
                }
            } else {
                $result = ['message' => 'Please provide valid username and password.', 'isMWSExist' => $isMWSExist, 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'isMWSExist' => $isMWSExist, 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * get User profile using email
     */
    public function actionGetUserProfile()
    {
        $email = Yii::$app->request->post('email');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            if($email) {
                $model = User::findOne(['u_email' => $email]);
                if($model) {
                    $asinCron = ($model->asin_change_cron_status) ? 1 : 0;
                    $orderCron = ($model->order_cron_status) ? 1 : 0;
                    $totalCrons = 2;
                    $completePercentage = (($asinCron + $orderCron)/$totalCrons)*100;

                    $userData = [
                        'name' => $model->u_name,
                        'email' => $model->u_email,
                        'mwsSellerId' => $model->u_mws_seller_id,
                        'mwsAuthKey' => $model->u_mws_auth_token,
                        'dataFetchProgress' => $completePercentage.'%',
                    ];
                    $result = ['message' => 'User has MWS Credentials', 'userData' => $userData, 'status' => true];
                } else {
                    $result = ['message' => 'User not found/Invalid email.', 'userData' => null, 'status' => false];
                }
            } else {
                $result = ['message' => 'Please provide valid email.', 'userData' => null, 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Check MWS status is exist or not
     * @return string
     */
    public function actionCheckMwsExist()
    {
        $email = Yii::$app->request->post('email');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($validSecretKey && $secretKey == $validSecretKey) {
            if($email) {
                $model = User::findOne(['u_email' => $email]);
                if($model) {
                    $mwsCredentials = ['mwsSellerId' => $model->u_mws_seller_id, 'mwsAuthKey' => $model->u_mws_auth_token];
                    $result = ['message' => 'User has MWS Credentials', 'mwsCredentials' => $mwsCredentials, 'status' => true];
                } else {
                    $result = ['message' => 'User not found/Invalid email.', 'mwsCredentials' => null, 'status' => false];
                }
            } else {
                $result = ['message' => 'Please provide valid email.', 'mwsCredentials' => null, 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'mwsCredentials' => null, 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * User sign up API
     * @return string
     */
    public function actionUserSignUp()
    {
        $result = [];
        $username = (Yii::$app->request->post('username')) ? Yii::$app->request->post('username') : Yii::$app->request->post('email');
        $email = Yii::$app->request->post('email');
        $password = Yii::$app->request->post('password'); // md5 password
        $confirmPassword = Yii::$app->request->post('confirmPassword');
        $secretKey = Yii::$app->request->post('secretKey');
        $apiVersion = Yii::$app->request->post('api_version');
        $deviceToken = Yii::$app->request->post('device_token');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        Stripe::setApiKey(Yii::$app->params['stripeApiKey']);

        if(!$apiVersion) {
            $result = ['message' => 'Please provide API version for stripe', 'status' => false];
            return Json::encode($result);
        }

        if($secretKey && $validSecretKey == $secretKey) {
            try {
                if($username && $password && $email) {
                    $checkEmail = User::find()->where(['u_email' => $email])->exists();
                    if($checkEmail) {
                        $result = ['message' => $email.' is already exists. Please enter another email.', 'status' => false];
                        return Json::encode($result);
                    }
                    $model = new User();
                    $model->u_name = $username;
                    $model->u_password = $password;
                    $model->u_email = $email;
                    $model->device_token = $deviceToken;
                    $model->u_type = 2;
                    if($model->save(false)) {

                        $customer = Customer::create(array(
                            "email" => $model->u_email,
                            //"source" => $token
                        ));

                        $key = $customerId = null;

                        if($customer) {
                            $customerId = $customer->id;

                            $key = \Stripe\EphemeralKey::create(
                                ["customer" => $customer->id],
                                ["stripe_version" => $apiVersion]
                            );

                            $modelU = User::findOne($model->u_id);
                            if($modelU) {
                                $modelU->u_cust_id = $customer->id;
                                $modelU->u_stripe_ephemeral_key = Json::encode($key);
                                $modelU->save(false);
                            }
                        }

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

                            $result = ['message' => 'Register Successfully.', 'userId' => $model->u_id, 'stripeCustomerId' => $customerId, 'stripeEphemeralKey' => $key, 'status' => true];
                        } catch (\Exception $e) {
                            $result = ['message' => 'Something went wrong. '.$e->getMessage(), 'status' => false];
                        }
                    } else {
                        $result = ['message' => 'Please provide valid email, password', 'status' => false];
                    }
                } else {
                    $result = ['message' => 'Please provide valid data.', 'status' => false];
                }
            } catch (\Exception $e) {
                $result = ['message' => 'Something went wrong. '.$e->getMessage(), 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Request mail for Min MAx Cost upload
     * @return string
     */
    public function actionRequestMinMaxCost()
    {
        $email = Yii::$app->request->post('email');
        $result = ['message' => '', 'status' => false];
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                $id = \Yii::$app->security->encryptByKey($userData->u_id, \Yii::$app->request->cookieValidationKey);
                $subjectCsv = "[Price Genius]: Upload your Cost/Min/Max";
                $csvLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/upload-cost-csv', 'id' => $id]);
                $dCsvLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/download-cost-csv']);
                $contentCsv = ['userName' => $userData->u_name, 'downloadCsvLink' => $dCsvLink, 'uploadCsvLink' => $csvLink];
                $promotionNameCsv = "Min Max Cost";
                $status = SendMail::sendSupportMail($userData->u_email, $userData->u_name, $subjectCsv, $contentCsv, $promotionNameCsv);
                $result = ['message' => 'Email sent successfully on register email.', 'status' => true];
            } else {
                $result = ['message' => 'Please provide email', 'status' => false,];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Get All Active ASNs
     * @return string
     */
    public function actionGetProductData()
    {
        $email = Yii::$app->request->post('email');
        $result = ['message' => '', 'status' => false, 'data' => null];
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {

                $cPage = Yii::$app->request->get('page');
                $query = FbaAllListingData::find();

                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => [
                        'defaultPageSize' => 20, //set page size here
                    ]
                ]);
                $asinData = $dataProvider->getModels();
                $totalPages = $dataProvider->pagination->pageCount;
                $result = ['message' => 'No data found.', 'status' => false];
                $asinList = [];

                if(!is_null($cPage) && ($cPage <= 0 || $cPage > $totalPages)) {
                    return Json::encode(['message' => 'Please provide valid pagination value.', 'status' => false]);
                }

                if ($asinData) {
                    foreach ($asinData as $model) {
                        $listingData = [
                            'prodName' => $model->item_name,
                            'prodSku' => $model->seller_sku,
                            'prodAsin' => $model->asin1,
                            'feesComDollar' => $model->commission_fees,
                            'feesFbaDollar' => $model->fba_fees,
                            'priceBuybox' => $model->buybox_price,
                            'priceCurrent' => $model->price,
                            'priceMax' => $model->repricing_max_price,
                            'priceMin' => $model->repricing_min_price,
                            'prodCost' => $model->buy_cost,
                            'prodDateListed' => $model->open_date,
                            'prodImage' => $model->image_url,
                            'rule' => $model->repricing_rule_id,
                        ];
                        //$feesList
                        $asinList[] = $listingData; //array_merge($listingData, $ruleArray);
                    }
                    if(count($asinList) < 20) {
                        $pageStatus = ['hasNextPage' => false, 'lastPage' => true];
                    } else {
                        $pageStatus = ['hasNextPage' => true];
                    }
                    $totalPagesA = ['totalPages' => $totalPages];
                    $asinList = array_merge($asinList, $totalPagesA, $pageStatus);

                    $result = ['message' => 'Data found.', 'status' => true, 'data' => $asinList];
                }
            } else {
                $result = ['message' => 'Please provide email', 'status' => false, 'data' => null];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * @return string
     */
    public function actionGetProductDataOld()
    {
        $email = Yii::$app->request->post('email');
        $result = ['message' => '', 'status' => false, 'data' => null];
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                $checkData = FbaAllListingData::find()->andWhere(['created_by' => $userData->u_id])->exists();

                if(!$checkData) {
                    $rr = Yii::$app->api->getAllListingReportList(true);
                    $reportId = ($rr) ? $rr[0]['ReportId'] : null;
                    if ($reportId) {
                        $rrData = \Yii::$app->api->getAllListingReport($reportId);
                        $remove = "\n";
                        $split = explode($remove, $rrData['data']);

                        $array[] = null;
                        $tab = "\t";

                        foreach ($split as $string) {
                            $row = explode($tab, $string);
                            array_push($array, $row);
                        }
                        $array = array_filter($array);
                        $tHead = $array[1];
                        unset($array[1]);

                        foreach ($array as $line) {
                            if (!array_filter($line))
                                continue;

                            $model = FbaAllListingData::find()->andWhere(['asin1' => $line[16], 'created_by' => $userData->u_id])->exists();
                            if(!$model) {
                                $model = new FbaAllListingData();
                            } else {
                                continue;
                            }
                            $model->item_name = utf8_encode($line[0]);
                            $model->item_description = (key_exists(1, $line)) ? $line[1] : null;
                            $model->listing_id = (key_exists(2, $line)) ? $line[2] : null;
                            $model->seller_sku = (key_exists(3, $line)) ? $line[3] : null;
                            $model->price = (key_exists(4, $line)) ? $line[4] : null;
                            $model->quantity = (key_exists(5, $line)) ? $line[5] : null;
                            $model->open_date = (key_exists(6, $line)) ? $line[6] : null;
                            $model->image_url = (key_exists(7, $line)) ? str_replace('._SL75_', '', $line[7]) : null;
                            $model->item_is_marketplace = (key_exists(8, $line)) ? $line[8] : null;
                            $model->product_id_type = (key_exists(9, $line)) ? $line[9] : null;
                            $model->zshop_shipping_fee = (key_exists(10, $line)) ? $line[10] : null;
                            $model->item_note = (key_exists(11, $line)) ? $line[11] : null;
                            $model->item_condition = (key_exists(12, $line)) ? $line[12] : null;
                            $model->zshop_category1 = (key_exists(13, $line)) ? $line[13] : null;
                            $model->zshop_browse_path = (key_exists(14, $line)) ? $line[14] : null;
                            $model->zshop_storefront_feature = (key_exists(15, $line)) ? $line[15] : null;
                            $model->asin1 = (key_exists(16, $line)) ? $line[16] : null;
                            $model->asin2 = (key_exists(17, $line)) ? $line[17] : null;
                            $model->asin3 = (key_exists(18, $line)) ? $line[18] : null;
                            $model->will_ship_internationally = (key_exists(19, $line)) ? $line[19] : null;
                            $model->expedited_shipping = (key_exists(20, $line)) ? $line[20] : null;
                            $model->zshop_boldface = (key_exists(21, $line)) ? $line[21] : null;
                            $model->product_id = (key_exists(22, $line)) ? $line[22] : null;
                            $model->bid_for_featured_placement = (key_exists(23, $line)) ? $line[23] : null;
                            $model->add_delete = (key_exists(24, $line)) ? $line[24] : null;
                            $model->pending_quantity = (key_exists(25, $line)) ? $line[25] : null;
                            $model->fulfillment_channel = (key_exists(26, $line)) ? $line[26] : null;
                            $model->merchant_shipping_group = (key_exists(27, $line)) ? $line[27] : null;
                            $model->status = (key_exists(28, $line)) ? $line[28] : null;
                            $model->fald_date = date('Y-m-d');
                            $model->created_by = $userData->u_id;
                            $model->updated_by = $userData->u_id;
                            $model->save(false);
                        }
                    }
                }

                $asinData = FbaAllListingData::find()->andWhere(['created_by' => $userData->u_id, 'status' => 'Active'])->all();
                $result = ['message' => 'No data found.', 'status' => false];
                $asinList = [];

                if ($asinData) {
                    foreach ($asinData as $model) {
                        $asinData = OrderItemsAsin::findOne(['oia_asin' => $model->asin1]);
                        $orderId = ($asinData) ? $asinData->oia_order_id : null;
                        $feesList = [];
                        if($orderId) {
                            $feesData = ItemFeeListData::find()->andWhere(['ifld_amazon_order_id' => $orderId])->all();
                            $feesList = ArrayHelper::map($feesData, 'ifld_fee_type', 'ifld_fee_amount');
                        }

                        /*$ruleData = AppliedRepriserRule::findOne(['arr_sku' => $model->seller_sku]);
                        $ruleId = ($ruleData) ? $ruleData->arr_rule_id : null;
                        $ruleName = null;
                        if($ruleId) {
                            $ruleNameData = RepriserRule::findOne($ruleId);
                            $ruleName = ($ruleNameData) ? $ruleNameData->rr_name : null;
                        }
                        $ruleArray = ['ruleName' => $ruleName];*/ //'ruleId' => $ruleId,

                        $fees = Yii::$app->api->mwsFeesEstimate($model->asin1, $model->price, 'USD', 'ASIN');
                        $fbaCommFees = $fbaFees = null;
                        if($fees) {
                            $fbaCommFees =($model->commission_fees) ? $model->commission_fees : $fees['ReferralFee'];
                            $fbaFees = ($model->fba_fees) ? $model->fba_fees : $fees['TotalFeesEstimate'];
                            //$fbaFees = ($fees['VariableClosingFee'] + $fees['PerItemFee'] + $fees['FBAWeightHandling'] + $fees['FBAOrderHandling'] + $fees['FBAPickAndPack']);
                        }

                        $listingData = [
                            'prodName' => $model->item_name,
                            'prodSku' => $model->seller_sku,
                            'prodAsin' => $model->asin1,
                            'feesComDollar' => $fbaCommFees,
                            'feesFbaDollar' => $fbaFees,
                            'priceBuybox' => $model->buybox_price,
                            'priceCurrent' => $model->price,
                            'priceMax' => $model->repricing_max_price,
                            'priceMin' => $model->repricing_min_price,
                            'prodCost' => $model->buy_cost,
                            'prodDateListed' => $model->open_date,
                            'prodImage' => $model->image_url,
                            'rule' => $model->repricing_rule_id,
                        ];

                        //$feesList
                        $asinList[] = $listingData; //array_merge($listingData, $ruleArray);
                    }
                    $result = ['message' => 'Data found.', 'status' => true, 'data' => $asinList];
                }
            } else {
                $result = ['message' => 'Please provide email', 'status' => false, 'data' => null];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Get FBA fees
     * @return string
     */
    public function actionGetFbaFees()
    {
        $email = Yii::$app->request->post('email');
        $sku = Yii::$app->request->post('sku');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData && $sku) {
                $asinData = FbaAllListingData::find()->andWhere(['created_by' => $userData->u_id, 'seller_sku' => $sku, 'status' => 'Active'])->one();
                $price = ($asinData) ? $asinData->buybox_price : 0;
                if($price) {
                    $fees = Yii::$app->api->mwsFeesEstimate($asinData->asin1, $price);
                    $fbaCommFees = $fbaFees = null;
                    if($fees) {
                        $fbaCommFees =($asinData->commission_fees) ? $asinData->commission_fees : $fees['ReferralFee'];
                        $fbaFees = ($asinData->fba_fees) ? $asinData->fba_fees : $fees['TotalFeesEstimate'];
                        //$fbaFees = ($fees['VariableClosingFee'] + $fees['PerItemFee'] + $fees['FBAWeightHandling'] + $fees['FBAOrderHandling'] + $fees['FBAPickAndPack']);

                        $feesData = [
                            'fbaCommFess' => $fbaCommFees,
                            'fbaFees' => $fbaFees,
                        ];
                        $result = ['message' => 'Fees Data found.', 'status' => true, 'data' => $feesData];
                    } else {
                        $result = ['message' => 'Fees Data not found.', 'status' => false, 'data' => null];
                    }
                } else {
                    $result = ['message' => 'SKU Data not found.', 'status' => false];
                }
            } else {
                $result = ['message' => 'User Data not found. Please provide valid email id.', 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Get all Order Data
     * @return string
     */
    public function actionGetOrders()
    {
        $email = Yii::$app->request->post('email');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                $this->setMwsCredentials($userData->u_mws_seller_id, $userData->u_mws_auth_token);

                $time = strtotime("-1 months", time());
                $sDate = date("Y-m-d", $time);
                $eDate = date('Y-m-d');

                $orderData = AllOrdesList::find()->all(); //->andWhere(['aol_user_id' => $userData->u_id])

                if(!$orderData) {
                    $orderList = \Yii::$app->api->getOrdersList('Modified', $sDate, $eDate);
                    foreach ($orderList as $order) {
                        $order = (array)$order;
                        $order = array_shift($order);
                        if ($order) {
                            $model = new AllOrdesList();
                            $model->aol_amazon_order_id = (key_exists('AmazonOrderId', $order)) ? $order['AmazonOrderId']: null;
                            $model->aol_seller_order_id = (key_exists('SellerOrderId', $order)) ? $order['SellerOrderId'] : null;
                            $model->aol_purchase_date = (key_exists('PurchaseDate', $order)) ? $order['PurchaseDate'] : null;
                            $model->aol_last_updated_date = (key_exists('LastUpdateDate', $order)) ? $order['LastUpdateDate'] : null;
                            $model->aol_order_status = (key_exists('OrderStatus', $order)) ? $order['OrderStatus'] : null;
                            $model->aol_fulfilment_channel = (key_exists('FulfillmentChannel', $order)) ? $order['FulfillmentChannel'] : null;
                            $model->aol_sales_channel = (key_exists('SalesChannel', $order)) ? $order['SalesChannel'] : null;
                            $model->aol_ship_service = (key_exists('ShipServiceLevel', $order)) ? $order['ShipServiceLevel'] : null;
                            $model->aol_order_total = (key_exists('OrderTotal', $order)) ? $order['OrderTotal']['Amount'] : 0;
                            $model->aol_shipped_items = (key_exists('NumberOfItemsShipped', $order)) ? $order['NumberOfItemsShipped'] : null;
                            $model->aol_unshipped_items = (key_exists('NumberOfItemsUnshipped', $order)) ? $order['NumberOfItemsUnshipped'] : null;
                            $model->aol_user_id = $userData->u_id;
                            if ($model->save(false)) {
                                echo "Data Saved.";
                            }
                        }
                    }
                }

                $orderDataQ = AllOrdesList::find(); //->andWhere(['aol_user_id' => $userData->u_id])
                $orderCountData = clone $orderDataQ;
                $numrows = $orderCountData->count();

                // number of rows to show per page
                $rowsperpage = 20;

                // find out total pages
                $totalpages = ceil($numrows / $rowsperpage);

                // get the current page or set a default
                if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
                    $currentpage = (int) $_REQUEST['page'];

                    if($currentpage <= 0 || $currentpage > $totalpages) {
                        return Json::encode(['message' => 'Please provide valid pagination value.', 'status' => false]);
                    }
                } else {
                    $currentpage = 1;  // default page number
                }

                // if current page is greater than total pages
                if ($currentpage > $totalpages) {
                // set current page to last page
                    $currentpage = $totalpages;
                }
                // if current page is less than first page
                if ($currentpage < 1) {
                // set current page to first page
                    $currentpage = 1;
                }

                // the offset of the list, based on current page
                $offset = ($currentpage - 1) * $rowsperpage;

                $orderData = $orderDataQ->limit($rowsperpage)->offset($offset)->all();
                $result = ['message' => 'No data found.', 'status' => false];
                $orderList = [];

                if ($orderData) {
                    $sku = null;
                    foreach ($orderData as $model) {
                        /*$asinData = OrderItemsAsin::findOne(['oia_order_id' => $model->aol_amazon_order_id]);
                        if($asinData) {
                            $sku = ($asinData->sku) ? $asinData->sku->seller_sku : null;
                        }*/
                        $sku = ($model->orderFees) ? $model->orderFees->ifld_seller_sku : null;
                        $skuArray = ['sku' => $sku, 'totalItemsInOrder' => ($model->aol_shipped_items + $model->aol_unshipped_items)];

                        $orderList[] = array_merge($model->attributes, $skuArray);
                    }
                    $result = ['message' => 'Data found.', 'status' => true, 'data' => $orderList];
                }
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Create new rule for repriser
     * @return string
     */
    public function actionAddRule()
    {
        $postData = \Yii::$app->request->post();
        $result = ['message' => 'Please provide valid data', 'status' => false];

        $email = Yii::$app->request->post('email');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                if ($postData) {
                    $ruleName = \Yii::$app->request->post('ruleName');
                    $ruleGoal = \Yii::$app->request->post('ruleGoal');
                    $matchAction = \Yii::$app->request->post('matchAction');
                    $pricingAction = \Yii::$app->request->post('pricingAction');
                    $pricingAmount = \Yii::$app->request->post('pricingAmount');
                    $pricingAmountType = \Yii::$app->request->post('pricingAmountType');
                    $ruleComparison = \Yii::$app->request->post('ruleComparison');
                    $ruleComparisonIgnoreAmz = \Yii::$app->request->post('ruleComparisonIgnoreAmz');
                    $raisePrice = \Yii::$app->request->post('raisePrice');
                    $raisePriceAction = \Yii::$app->request->post('raisePriceAction');
                    $raisePriceAmount = \Yii::$app->request->post('raisePriceAmount');
                    $raisePriceAmountType = \Yii::$app->request->post('raisePriceAmountType');
                    $raisePriceComparison = \Yii::$app->request->post('raisePriceComparison');
                    $raisePriceIgnoreAmz = \Yii::$app->request->post('raisePriceIgnoreAmz');

                    $model = new RepriserRule();
                    $model->rr_name = $ruleName;
                    $model->rr_goal = $ruleGoal;
                    $model->rr_match_action = $matchAction;
                    $model->rr_pricing_action = $pricingAction;
                    $model->rr_pricing_amount = $pricingAmount;
                    if($pricingAmountType == 2) {
                        $model->rr_pricing_amount_type = 2;
                    } else {
                        $model->rr_pricing_amount_type = 1;
                    }
                    if($raisePriceAmountType == 2) {
                        $model->rr_raise_price_type = 2;
                    } else {
                        $model->rr_raise_price_type = 1;
                    }
                    //$model->rr_pricing_percentage = $pricingPercent;
                    $model->rr_rule_comparison = $ruleComparison;
                    $model->rr_rule_comparison_ignore_amazon = $ruleComparisonIgnoreAmz;
                    $model->rr_raise_price = $raisePrice;
                    $model->rr_raise_price_action = $raisePriceAction;
                    $model->rr_raise_price_amount = $raisePriceAmount;
                    //$model->rr_raise_price_percentage = $raisePricePercent;
                    $model->rr_raise_price_comparison = $raisePriceComparison;
                    $model->rr_raise_price_comparison_ignore_amazon = $raisePriceIgnoreAmz;
                    $model->created_by = $userData->u_id;
                    if ($model->save(false)) {
                        $result = ['ruleId' => $model->rr_id, 'message' => 'Success! New Rule created.', 'status' => true];
                    }
                }
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Update rule for repriser
     * @return string
     */
    public function actionUpdateRule()
    {
        $postData = \Yii::$app->request->post();
        $ruleId = \Yii::$app->request->post('ruleId');
        $result = ['message' => 'Please provide valid data', 'status' => false];

        $email = Yii::$app->request->post('email');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                if ($postData && $ruleId) {
                    $ruleName = \Yii::$app->request->post('ruleName');
                    $ruleGoal = \Yii::$app->request->post('ruleGoal');
                    $matchAction = \Yii::$app->request->post('matchAction');
                    $pricingAction = \Yii::$app->request->post('pricingAction');
                    $pricingAmount = \Yii::$app->request->post('pricingAmount');
                    //$pricingPercent = \Yii::$app->request->post('pricingPercent');
                    $pricingAmountType = \Yii::$app->request->post('pricingAmountType');
                    $ruleComparison = \Yii::$app->request->post('ruleComparison');
                    $ruleComparisonIgnoreAmz = \Yii::$app->request->post('ruleComparisonIgnoreAmz');
                    $raisePrice = \Yii::$app->request->post('raisePrice');
                    $raisePriceAction = \Yii::$app->request->post('raisePriceAction');
                    $raisePriceAmount = \Yii::$app->request->post('raisePriceAmount');
                    //$raisePricePercent = \Yii::$app->request->post('raisePricePercent');
                    $raisePriceAmountType = \Yii::$app->request->post('raisePriceAmountType');
                    $raisePriceComparison = \Yii::$app->request->post('raisePriceComparison');
                    $raisePriceIgnoreAmz = \Yii::$app->request->post('raisePriceIgnoreAmz');

                    $model = RepriserRule::findOne($ruleId);
                    if ($model) {
                        $model->rr_name = $ruleName;
                        $model->rr_goal = $ruleGoal;
                        $model->rr_match_action = $matchAction;
                        $model->rr_pricing_action = $pricingAction;
                        $model->rr_pricing_amount = $pricingAmount;
                        //$model->rr_pricing_percentage = $pricingPercent;
                        if($raisePriceAmount == 2) {
                            $model->rr_pricing_amount_type = 2;
                        } else {
                            $model->rr_pricing_amount_type = 1;
                        }
                        if($raisePriceAmountType == 2) {
                            $model->rr_raise_price_type = 2;
                        } else {
                            $model->rr_raise_price_type = 1;
                        }
                        $model->rr_rule_comparison = $ruleComparison;
                        $model->rr_rule_comparison_ignore_amazon = $ruleComparisonIgnoreAmz;
                        $model->rr_raise_price = $raisePrice;
                        $model->rr_raise_price_action = $raisePriceAction;
                        $model->rr_raise_price_amount = $raisePriceAmount;
                        //$model->rr_raise_price_percentage = $raisePricePercent;
                        $model->rr_raise_price_comparison = $raisePriceComparison;
                        $model->rr_raise_price_comparison_ignore_amazon = $raisePriceIgnoreAmz;
                        if ($model->save(false)) {
                            $result = ['message' => 'Success! New Rule created.', 'status' => true];
                        }
                    } else {
                        $result = ['message' => 'Repricer Rule not found.', 'status' => false];
                    }
                }
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Get current rules for user
     * @return string
     */
    public function actionGetRules()
    {
        $email = \Yii::$app->request->post('email');
        $result = ['message' => 'Please provide valid email id.', 'status' => false];

        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            if ($email) {
                $model = User::findOne(['u_email' => $email]);
                if ($model) {
                    $ruleList = [];
                    $ruleData = RepriserRule::find()->andWhere(['created_by' => $model->u_id])->all();
                    if ($ruleData) {
                        foreach ($ruleData as $rd) {
                            $pSkuData = FbaAllListingData::find()->select(['seller_sku'])->where(['repricing_rule_id' => $rd->rr_id])->column();
                            $ruleDataAr = [
                                'ruleID' => $rd->rr_id,
                                'name' => $rd->rr_name,
                                'creationDate' => date('Y-m-d H:i:s', $rd->created_at),
                                'buyboxOrLowest' => $rd->getGoal($rd->rr_goal),
                                'action' => $rd->rr_match_action,
                                'actionAmount' => $rd->rr_pricing_amount,
                                'actionAmountType' => $rd->rr_pricing_amount_type,
                                'competeWith' => $rd->rr_rule_comparison,
                                'ignoreAmazon' => $rd->rr_rule_comparison_ignore_amazon,
                                'products' => $pSkuData,
                            ];
                            $ruleList[] = $ruleDataAr; //$rd->attributes;
                        }
                        $result = ['message' => 'Rule Data found.', 'status' => true, 'data' => $ruleList];
                    } else {
                        $result = ['message' => 'Rule data not found.', 'data' => null, 'status' => false];
                    }
                } else {
                    $result = ['message' => 'User not found.', 'status' => false];
                }
            } else {
                $result = ['message' => 'Please provide email id.', 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Delete Repricer Rule
     * @return string
     */
    public function actionDeleteRule()
    {
        $ruleId = \Yii::$app->request->post('ruleId');
        $result = ['message' => 'Please provide valid rule id.', 'status' => false];
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            if($ruleId) {
                $model = RepriserRule::findOne($ruleId);
                if($model) {
                    $model->delete();

                    $result = ['message' => 'Repricer Rule deleted successfully.', 'status' => true];
                } else {
                    $result = ['message' => 'Repricer Rule not found.', 'status' => false];
                }
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Magic repricing
     * @return string
     */
    public function actionMagicRepricing()
    {
        $asin = (Yii::$app->request->post('asin')) ? Yii::$app->request->post('asin') : Yii::$app->request->post('sku');
        $finalPrice = 0;
        $email = Yii::$app->request->post('email');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];
        $offerSummary = [];

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                if (Yii::$app->request->post() && $asin) {
                    $productOffer = Yii::$app->data->getAllOffers($asin, 'SKU');
                    $yourBuyBox = Yii::$app->request->post('yourPrice');
                    $minPrice = Yii::$app->request->post('minPrice');
                    $maxPrice = Yii::$app->request->post('maxPrice');
                    $rRule = Yii::$app->request->post('repriserRule');

                    if ($productOffer) {
                        ProductOffers::deleteAll(['po_asin' => $asin, 'created_by' => $userData->u_id]);
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
                            $model->created_by = $userData->u_id;
                            $model->save(false);
                        }

                        $offerSummaryData = ProductOffers::find()->andWhere(['po_asin' => $asin])->one();
                        $offerSummary = $offerSummaryData->attributes;

                        $rRuleData = RepriserRule::findOne($rRule);
                        if ($rRuleData) {
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

                            if ($rRuleData->rr_match_action == 1) {
                                if ($spPercent) {
                                    $bAmount = ($comPrice * $spPercent) / 100;
                                    $tempPrice = $comPrice - $bAmount;
                                }
                                if ($spPrice) {
                                    $tempPrice = $comPrice - $spPrice;
                                }
                            } elseif ($rRuleData->rr_match_action == 3) {
                                if ($spPercent) {
                                    $bAmount = ($comPrice * $spPercent) / 100;
                                    $tempPrice = $comPrice + $bAmount;
                                }
                                if ($spPrice) {
                                    $tempPrice = $comPrice + $spPrice;
                                }
                            } else {
                                $tempPrice = $comPrice;
                            }

                            if ($tempPrice) {
                                if($tempPrice <= $maxPrice && $tempPrice >= $minPrice) {
                                    $finalPrice = $tempPrice;
                                }  else {
                                    $finalPrice = $yourBuyBox;
                                }

                                /*elseif ($tempPrice <= $yourBuyBox) {
                                    $finalPrice = $yourBuyBox;
                                } else {
                                    $finalPrice = $maxPrice;
                                }*/
                                return Json::encode(['finalPrice' => $finalPrice, 'offerSummary' => $offerSummary, 'status' => true]);
                            } else {
                                $finalPrice = $yourBuyBox;
                                return Json::encode(['finalPrice' => $finalPrice, 'offerSummary' => $offerSummary, 'status' => true]);
                            }
                        }
                    }
                }
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
            return Json::encode($result);
        }

        if($finalPrice) {
            return Json::encode(['finalPrice' => $finalPrice, 'offerSummary' => $offerSummary, 'status' => true]);
        } else {
            return Json::encode(['finalPrice' => $finalPrice, 'offerSummary' => $offerSummary, 'status' => false]);
        }
    }

    /**
     * Add SKU to Repricing Rule
     * @return string
     */
    public function actionAddSkuToRule()
    {
        $asin = (Yii::$app->request->post('asin')) ? Yii::$app->request->post('asin') : Yii::$app->request->post('sku');
        $finalPrice = 0;
        $email = Yii::$app->request->post('email');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];
        $offerSummary = [];

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                if (Yii::$app->request->post() && $asin) {
                    $productOffer = Yii::$app->data->getAllOffers($asin, 'SKU');
                    $yourBuyBox = Yii::$app->request->post('priceCurrent');
                    $minPrice = Yii::$app->request->post('minPrice');
                    $maxPrice = Yii::$app->request->post('maxPrice');
                    $rRule = Yii::$app->request->post('repriserRule');

                    if ($productOffer) {
                        ProductOffers::deleteAll(['po_asin' => $asin, 'created_by' => $userData->u_id]);
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
                            $model->created_by = $userData->u_id;
                            $model->save(false);
                        }

                        $offerSummaryData = ProductOffers::find()->andWhere(['po_asin' => $asin])->one();
                        $offerSummary = $offerSummaryData->attributes;

                        $rRuleData = RepriserRule::findOne($rRule);
                        if ($rRuleData) {
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

                            if ($rRuleData->rr_match_action == 1) {
                                if ($spPercent) {
                                    $bAmount = ($comPrice * $spPercent) / 100;
                                    $tempPrice = $comPrice - $bAmount;
                                }
                                if ($spPrice) {
                                    $tempPrice = $comPrice - $spPrice;
                                }
                            } elseif ($rRuleData->rr_match_action == 3) {
                                if ($spPercent) {
                                    $bAmount = ($comPrice * $spPercent) / 100;
                                    $tempPrice = $comPrice + $bAmount;
                                }
                                if ($spPrice) {
                                    $tempPrice = $comPrice + $spPrice;
                                }
                            } else {
                                $tempPrice = $comPrice;
                            }

                            if($asin) {
                                $skuData = FbaAllListingData::find()->andWhere(['seller_sku' => $asin])->exists();
                                if($skuData) {
                                    FbaAllListingData::updateAll(['repricing_min_price' => $minPrice, 'repricing_max_price' => $maxPrice, 'repricing_rule_id' => $rRule, 'repricing_cost_price' => $finalPrice], ['seller_sku' => $asin]);
                                }
                            }

                            if ($tempPrice) {
                                if($tempPrice <= $maxPrice && $tempPrice >= $minPrice) {
                                    $finalPrice = $tempPrice;
                                }  else {
                                    $finalPrice = $yourBuyBox;
                                }

                                $rModel = new AppliedRepriserRule();
                                $rModel->arr_sku = $asin;
                                $rModel->arr_user_email = $email;
                                $rModel->arr_user_id = $userData->u_id;
                                $rModel->arr_min_price = $minPrice;
                                $rModel->arr_max_price = $maxPrice;
                                $rModel->arr_repriser_price = $finalPrice;
                                $rModel->arr_date = date('Y-m-d');
                                $rModel->arr_rule_id = $rRule;
                                $rModel->arr_own_buy_box_price = $yourBuyBox;
                                $rModel->save(false);

                                return Json::encode(['message' => 'Repricer Price saved successfully.', 'finalPrice' => $finalPrice, 'offerSummary' => $offerSummary, 'status' => true]);
                            } else {
                                $finalPrice = $yourBuyBox;

                                $rModel = new AppliedRepriserRule();
                                $rModel->arr_sku = $asin;
                                $rModel->arr_user_email = $email;
                                $rModel->arr_user_id = $userData->u_id;
                                $rModel->arr_min_price = $minPrice;
                                $rModel->arr_max_price = $maxPrice;
                                $rModel->arr_repriser_price = $finalPrice;
                                $rModel->arr_date = date('Y-m-d');
                                $rModel->arr_rule_id = $rRule;
                                $rModel->arr_own_buy_box_price = $yourBuyBox;
                                $rModel->save(false);

                                return Json::encode(['finalPrice' => $finalPrice, 'offerSummary' => $offerSummary, 'status' => true]);
                            }
                        }
                    }
                }
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
            return Json::encode($result);
        }

        if($finalPrice) {
            return Json::encode(['finalPrice' => $finalPrice, 'offerSummary' => $offerSummary, 'status' => true]);
        } else {
            return Json::encode(['finalPrice' => $finalPrice, 'offerSummary' => $offerSummary, 'status' => false]);
        }
    }

    /**
     * Get Repricing rule SKU wise
     * @return string
     */
    public function actionGetSkuRule()
    {
        $asin = (Yii::$app->request->post('asin')) ? Yii::$app->request->post('asin') : Yii::$app->request->post('sku');
        $finalPrice = 0;
        $email = Yii::$app->request->post('email');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];
        $offerSummary = [];

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                if (Yii::$app->request->post() && $asin) {
                    $ruleData = AppliedRepriserRule::findOne(['arr_sku' => $asin]);
                    if($ruleData) {
                        $ruleD = RepriserRule::findOne(['rr_id' => $ruleData->arr_rule_id]);
                        if($ruleD) {
                            $ruleDataArray = [
                                'ruleName' => $ruleD->rr_name,
                                'ruleGoal' => $ruleD->rr_goal,
                                'ruleMatchAction' => $ruleD->rr_match_action,
                                'pricingAction' => $ruleD->rr_pricing_action,
                                'pricingAmount' => $ruleD->rr_pricing_amount,
                                'pricingAmountType' => $ruleD->rr_pricing_amount_type,
                                'ruleComparison' => $ruleD->rr_rule_comparison,
                                'ruleComparisonIgnoreAmazon' => $ruleD->rr_rule_comparison_ignore_amazon,
                                'raisePrice' => $ruleD->rr_raise_price,
                                'raisePriceAction' => $ruleD->rr_raise_price_action,
                                'raisePriceAmount' => $ruleD->rr_raise_price_amount,
                                'raisePriceAmountType' => $ruleD->rr_raise_price_type,
                                'raisePriceComparison' => $ruleD->rr_raise_price_comparison,
                                'raisePriceComparisonIgnoreAmazon' => $ruleD->rr_raise_price_comparison_ignore_amazon,
                            ];
                            return Json::encode(['message' => 'Rule Found.', 'data' => $ruleDataArray, 'status' => true]);
                        }
                        return Json::encode(['message' => 'Rule not Found.', 'data' => null, 'status' => false]);
                    }
                    return Json::encode(['message' => 'Rule not Found.', 'data' => null, 'status' => false]);
                }
                return Json::encode(['message' => 'please provide valid data', 'status' => false]);
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
            return Json::encode($result);
        }
    }

    /**
     * Get Assigned Rule of product
     * @return string
     */
    public function actionGetAssignedRuleProduct()
    {
        $ruleId = Yii::$app->request->post('ruleId');
        $email = Yii::$app->request->post('email');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];
        $offerSummary = [];

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                if (Yii::$app->request->post() && $ruleId) {
                    $skuData = AppliedRepriserRule::find()->select(['arr_sku'])->where(['arr_rule_id' => $ruleId, 'arr_user_id' => $userData->u_id])->column();
                    if($skuData) {
                        $productData = FbaAllListingData::find()->where(['seller_sku' => $skuData])->all();
                        if($productData) {
                            foreach ($productData as $pd) {
                                /*$fees = Yii::$app->api->mwsFeesEstimate($pd->asin1, $pd->price);
                                $fbaCommFees = $fbaFees = null;
                                if($fees) {
                                    $fbaCommFees = $fees['ReferralFee'];
                                    $fbaFees = ($fees['VariableClosingFee'] + $fees['PerItemFee'] + $fees['FBAWeightHandling'] + $fees['FBAOrderHandling'] + $fees['FBAPickAndPack']);
                                }*/
                                $listingData = [
                                    'prodName' => $pd->item_name,
                                    'prodSku' => $pd->seller_sku,
                                    'prodAsin' => $pd->asin1,
                                    //'feesComDollar' => $fbaCommFees,
                                    //'feesFbaDollar' => $fbaFees,
                                    'priceBuybox' => $pd->buybox_price,
                                    'priceCurrent' => $pd->price,
                                    'priceMax' => $pd->repricing_max_price,
                                    'priceMin' => $pd->repricing_min_price,
                                    'prodCost' => $pd->buy_cost,
                                    'prodDateListed' => $pd->open_date,
                                    'prodImage' => $pd->image_url,
                                ];
                                return Json::encode(['message' => 'Product List Found.', 'data' => $listingData, 'status' => true]);
                            }
                        }
                        return Json::encode(['message' => 'Products not Found.', 'data' => null, 'status' => false]);
                    }
                    return Json::encode(['message' => 'Product not Found.', 'data' => null, 'status' => false]);
                }
                return Json::encode(['message' => 'please provide valid data', 'status' => false]);
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
            return Json::encode($result);
        }
    }

    /**
     * Get all products (SKU) Buy box price
     * @return string
     */
    public function actionGetProductsBuyBox()
    {
        $email = Yii::$app->request->post('email');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];

        $listingData = [];
        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                if (Yii::$app->request->post()) {
                    $productData = FbaAllListingData::find()->all(); //->where(['created_by' => $userData->u_id])
                    if($productData) {
                        foreach ($productData as $pd) {
                            $listingData[] = [
                                'prodSku' => $pd->seller_sku,
                                'prodAsin' => $pd->asin1,
                                'priceBuybox' => $pd->buybox_price,
                            ];
                        }
                        return Json::encode(['message' => 'Products Found.', 'data' => $listingData, 'status' => true]);
                    }
                    return Json::encode(['message' => 'Products not Found.', 'data' => null, 'status' => false]);
                }
                return Json::encode(['message' => 'please provide valid data', 'status' => false]);
            }
            return Json::encode(['message' => 'User not found', 'status' => false]);
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
            return Json::encode($result);
        }
    }

    /**
     * Get Buy box price for specific SKU
     * @return string
     */
    public function actionGetSkuBuyBox()
    {
        $email = Yii::$app->request->post('email');
        $sku = Yii::$app->request->post('sku');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];
        $listingData = [];
        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                if (Yii::$app->request->post() && $sku) {
                    $productData = FbaAllListingData::find()->where(['seller_sku' => $sku])->all(); //'created_by' => $userData->u_id,
                    if($productData) {
                        foreach ($productData as $pd) {
                            $productBuyBox = \Yii::$app->api->getProductCompetitivePrice($pd->seller_sku);
                            $listingData[] = [
                                'prodSku' => $productBuyBox,
                                'prodAsin' => $pd->asin1,
                                'priceBuybox' => $pd->buybox_price,
                            ];
                        }
                        return Json::encode(['message' => 'Products Found.', 'data' => $listingData, 'status' => true]);
                    }
                    return Json::encode(['message' => 'Products not Found.', 'data' => null, 'status' => false]);
                }
                return Json::encode(['message' => 'please provide valid data', 'status' => false]);
            }
            return Json::encode(['message' => 'User not found', 'status' => false]);
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
            return Json::encode($result);
        }
    }

    /**
     * Remove Assigned rule from sKU
     * @return string
     */
    public function actionRemoveSkuRule()
    {
        $email = \Yii::$app->request->post('email');
        $result = ['message' => 'Please provide valid email id.', 'status' => false];
        $sku = \Yii::$app->request->post('sku');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            if ($email) {
                $model = User::findOne(['u_email' => $email]);
                if ($model) {
                    if($sku) {
                        $asinListStatus = FbaAllListingData::updateAll(['repricing_cost_price' => null, 'repricing_rule_id' => null, 'repricing_max_price' => null, 'repricing_min_price' => null], ['created_by' => $model->u_id, 'seller_sku' => $sku]);
                        if ($asinListStatus) {
                            $result = ['message' => 'Rule removed successfully.', 'status' => true];
                        } else {
                            $result = ['message' => 'Something went wrong.', 'status' => false];
                        }
                    } else {
                        $result = ['message' => 'Please provide sku.', 'status' => false];
                    }
                } else {
                    $result = ['message' => 'User not found.', 'status' => false];
                }
            } else {
                $result = ['message' => 'Please provide email id.', 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Update Current Price
     * @return string
     */
    public function actionUpdateCurrentPrice()
    {
        $email = \Yii::$app->request->post('email');
        $result = ['message' => 'Please provide valid email id.', 'status' => false];
        $sku = \Yii::$app->request->post('sku');
        $price = \Yii::$app->request->post('price');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            if ($email) {
                $model = User::findOne(['u_email' => $email]);
                if ($model) {
                    if($sku && $price) {
                        $priceStatus = FbaAllListingData::updateAll(['price' => $price], ['created_by' => $model->u_id, 'seller_sku' => $sku]);
                        if ($priceStatus) {
                            $result = ['message' => 'Price Updated.', 'status' => true];
                        } else {
                            $result = ['message' => 'Something went wrong.', 'status' => false];
                        }
                    } else {
                        $result = ['message' => 'Please provide sku.', 'status' => false];
                    }
                } else {
                    $result = ['message' => 'User not found.', 'status' => false];
                }
            } else {
                $result = ['message' => 'Please provide email id.', 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Update Product Buy box Price
     * @return string
     */
    public function actionUpdateBuyBoxPrice()
    {
        $email = \Yii::$app->request->post('email');
        $result = ['message' => 'Please provide valid email id.', 'status' => false];
        $sku = \Yii::$app->request->post('sku');
        $price = \Yii::$app->request->post('price');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            if ($email) {
                $model = User::findOne(['u_email' => $email]);
                if ($model) {
                    if($sku) {
                        $productBuyBox = \Yii::$app->api->getProductCompetitivePrice($sku);
                        if($productBuyBox) {
                            $priceStatus = FbaAllListingData::updateAll(['buybox_price' => $productBuyBox], ['created_by' => $model->u_id, 'seller_sku' => $sku]);
                            if ($priceStatus) {
                                $result = ['message' => 'Price Updated.', 'status' => true];
                            } else {
                                $result = ['message' => 'SKU not found/SKU not updated', 'status' => false];
                            }
                        } else {
                            $result = ['message' => 'Something went wrong from Amazon.', 'status' => false];
                        }
                    } else {
                        $result = ['message' => 'Please provide sku.', 'status' => false];
                    }
                } else {
                    $result = ['message' => 'User not found.', 'status' => false];
                }
            } else {
                $result = ['message' => 'Please provide email id.', 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * forgot password
     * @return string
     */
    public function actionForgotPassword()
    {
        $result = ['message' => 'Please provide valid email id.', 'status' => false];
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            $model = new PasswordResetRequestForm();
            if (Yii::$app->request->post()) {
                $email = \Yii::$app->request->post('email');
                $model->username = $email;
                if($email) {
                    if ($model->validate() && $model->sendEmail()) {
                        $result = ['message' => 'Reset Password link sent to your registered email. Check your email inbox for further instructions.', 'status' => true];
                    } else {
                        $result = ['message' => 'Sorry, we are unable to reset password for email provided.', 'status' => false];
                    }
                } else {
                    $result = ['message' => 'Please provide email id.', 'status' => false];
                }
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Reset Password
     * @param $token
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = 'main-login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            //echo "Your new password has been saved."; exit();
            Yii::$app->session->setFlash('success', 'Your new password has been saved.');
            return $this->redirect(['/api/password-reset-success']);
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionPasswordResetSuccess()
    {
        return $this->render('thank-you-password-view');
    }

    /**
     * Get Product Stock Count.
     * @return string
     */
    public function actionGetProductStocks()
    {
        $email = Yii::$app->request->post('email');
        $sku = Yii::$app->request->post('sku');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';
        $result = ['message' => '', 'status' => false, 'data' => null];
        $productList = [];

        if($secretKey && $validSecretKey == $secretKey) {
            $userData = ($email) ? User::findOne(['u_email' => $email]) : null;
            if ($userData) {
                $asinData = FbaAllListingData::find()->andWhere(['created_by' => $userData->u_id])->all();
                if($asinData) {
                    foreach ($asinData as $ad) {
                        $productList[] = [
                            'sku' => $ad->seller_sku,
                            'stock' => ($ad->productStock) ? $ad->productStock->quantity : null,
                        ];
                    }
                    $result = ['message' => 'Product Stock Data found.', 'status' => true, 'data' => $productList];
                } else {
                    $result = ['message' => 'Product Data not found.', 'status' => false];
                }
            } else {
                $result = ['message' => 'User Data not found. Please provide valid email id.', 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * Get Product Listed Date as per SKU
     * @return string
     */
    public function actionGetProductListedDate()
    {
        $email = \Yii::$app->request->post('email');
        $result = ['message' => 'Please provide valid email id.', 'status' => false];
        $sku = \Yii::$app->request->post('sku');
        $secretKey = Yii::$app->request->post('secretKey');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            if ($email) {
                $model = User::findOne(['u_email' => $email]);
                if ($model) {
                    if($sku) {
                        $asinData = FbaAllListingData::find()->andWhere(['created_by' => $model->u_id, 'seller_sku' => $sku])->one();
                        if ($asinData) {
                            //$prodDateListed = ($asinData->productReceived) ? $asinData->productReceived->received_date : null;
                            $prodDateListed = $asinData->open_date;
                            $result = ['prodDateListed' => $prodDateListed, 'prodSku' => $asinData->seller_sku, 'prodAsin' => $asinData->asin1, 'message' => 'Product Found.', 'status' => true];
                        } else {
                            $result = ['message' => 'SKU not found', 'status' => false];
                        }
                    } else {
                        $result = ['message' => 'Please provide sku.', 'status' => false];
                    }
                } else {
                    $result = ['message' => 'User not found.', 'status' => false];
                }
            } else {
                $result = ['message' => 'Please provide email id.', 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    public function actionSendPushNotification()
    {
        $result = ['message' => 'Please provide valid email id.', 'status' => false];
        $secretKey = Yii::$app->request->post('secretKey');
        $email = Yii::$app->request->post('email');
        $title = Yii::$app->request->post('title');
        $body = Yii::$app->request->post('description');
        $validSecretKey = 'repAWB654Ftrq$nhgtT6@$f%';

        if($secretKey && $validSecretKey == $secretKey) {
            if ($email) {
                $model = User::findOne(['u_email' => $email]);
                if ($model && $model->device_token) {
                    if($title && $body) {
                       $response = \Yii::$app->data->sendPushNotification($model->device_token, $title, $body);
                       if($response && key_exists('success', $response)) {
                           if($response['success']) {
                               $result = ['message' => 'Push notification has been send.', 'multicast_id' => $response['multicast_id'], 'status' => true];
                           } else {
                               $result = ['message' => 'Something went wrong. notification not sent', 'status' => false];
                           }
                       } else {
                           $result = ['message' => 'Push notification is not sent.', 'status' => false];
                       }
                    } else {
                        $result = ['message' => 'Please provide notification title and description..', 'status' => false];
                    }
                } else {
                    $result = ['message' => 'User/Device Token not found.', 'status' => false];
                }
            } else {
                $result = ['message' => 'Please provide email id.', 'status' => false];
            }
        } else {
            $result = ['message' => 'Please provide valid secret key', 'status' => false];
        }

        return Json::encode($result);
    }

    /**
     * set MWS Credentials for user
     * @param $sellerId
     * @param $mwsAuthToken
     */
    protected function setMwsCredentials($sellerId, $mwsAuthToken)
    {
        \Yii::$app->data->getMwsDetails($sellerId, $mwsAuthToken);
    }
}
