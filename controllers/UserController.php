<?php

namespace app\controllers;

use app\models\ClearanceData;
use app\models\ClearanceDataSearch;
use app\models\Employee;
use app\models\TodayDeals;
use app\models\TodayDealsSearch;
use app\models\UserData;
use app\models\UserDataSearch;
use Stripe\Customer;
use Stripe\Stripe;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['u_type' => 2]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCustomChargeIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['u_type' => 2]);

        return $this->render('charge-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCustomCharge($id)
    {
        $model = $this->findModel($id);

        if(($chargeAmount = Yii::$app->request->post('chargeAmount')) && ($comment = Yii::$app->request->post('chargeComment'))) {

            try {

                if($model->u_cust_id) {
                    Stripe::setApiKey(Yii::$app->params['stripeApiKey']);
                    //$customer = Customer::retrieve($model->u_cust_id);

                    $charge = \Stripe\Charge::create(array(
                        "amount" => $chargeAmount*100,
                        "currency" => "usd",
                        "customer" => $model->u_cust_id,
                        'description' => $comment,
                       // 'capture' => false,
                    ));

                    if($charge->status == 'succeeded') {
                        Yii::$app->session->setFlash('success', 'Amount successfully charged for '.$model->u_name);
                    } else {
                        Yii::$app->session->setFlash('error', 'Something went wrong.');
                    }
                    return $this->redirect(['custom-charge-index']);
                } else {
                    Yii::$app->session->setFlash('error', 'You need to first buy any plan.');
                    return $this->redirect(['custom-charge-index']);
                }
            } catch (\Stripe\Error\Card $e) {
                Yii::$app->session->setFlash('error', 'Something went wrong for Card.'.$e->getMessage());
                return $this->redirect(['custom-charge-index']);
            } catch (\Stripe\Error\InvalidRequest $e) {
                Yii::$app->session->setFlash('error', 'Something went wrong for Invalid Request. '.$e->getMessage());
                return $this->redirect(['custom-charge-index']);
            } catch (\Stripe\Error\Authentication $e) {
                Yii::$app->session->setFlash('error', 'Something went wrong for Authentication.'.$e->getMessage());
                return $this->redirect(['custom-charge-index']);
            } catch (\Stripe\Error\ApiConnection $e) {
                Yii::$app->session->setFlash('error', 'Something went wrong for API Connection.'.$e->getMessage());
                return $this->redirect(['custom-charge-index']);
            } catch (\Stripe\Error\Base $e) {
                Yii::$app->session->setFlash('error', 'Something went wrong for Base Error.'.$e->getMessage());
                return $this->redirect(['custom-charge-index']);
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', 'Something went wrong. Code Bug '.$e->getMessage());
                return $this->redirect(['custom-charge-index']);
            }
        }

        return $this->renderAjax('custom-charge-modal', [
            'model' => $model,
        ]);
    }

    public function actionCustomerHistory($id)
    {
        $model = $this->findModel($id);
        $chargeList = [];

        if($model->u_cust_id) {
            Stripe::setApiKey(Yii::$app->params['stripeApiKey']);
            $chargeData = \Stripe\Charge::all(["customer" => $model->u_cust_id]);

            if($chargeData) {
                $chargeList = $chargeData['data'];
            }
        }

        return $this->renderAjax('charge-history', ['model' => $model, 'chargeList' => $chargeList]);
    }

    public function actionSellerCredentials()
    {
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save(false);

            return $this->refresh();
        }
        return $this->render('seller-credentials', ['model' => $model]);
    }

    public function actionNotificationSetting()
    {
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save(false);

            return $this->refresh();
        }
        return $this->render('notification-setting', ['model' => $model]);
    }

    public function actionVaList()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['employee'])->where(['u_type' => 3]);

        return $this->render('va-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(Yii::$app->user->identity->u_type == 2) {
            if($id != Yii::$app->user->id)
            {
                throw new ForbiddenHttpException('Your are not allow to access this page', '403');
            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            $model->u_photo = UploadedFile::getInstance($model,'u_photo');
            $model->u_password = md5($model->u_password);

            if($model->u_photo)
            {
                $model->u_photo->saveAs(Yii::getAlias('@webroot').'/images/user-images/'.$model->u_photo = 'user_'.date("d-m-Y_His").'.'.$model->u_photo->extension);
            }
            else
                $model->u_photo = NULL;

            if($model->save(false))
                return $this->redirect(['index']);
        }
        $model->u_password = null;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->identity->u_type == 2) {
            if($id != Yii::$app->user->id)
            {
                throw new ForbiddenHttpException('Your are not allow to access this page', '403');
            }
        }

        $model = $this->findModel($id);
        $oldImage = $model->u_photo;
        $oldPassword = $model->u_password;

        if ($model->load(Yii::$app->request->post())) {
            $model->u_photo = UploadedFile::getInstance($model,'u_photo');

            if(!empty($model->u_password))
                $model->u_password = md5($model->u_password);
            else
                $model->u_password = $oldPassword;

            if($model->u_photo)
            {
                $model->u_photo->saveAs(Yii::getAlias('@webroot').'/images/user-images/'.$model->u_photo = 'user_'.date("d-m-Y_His").'.'.$model->u_photo->extension);
            }
            else
                $model->u_photo = $oldImage;

            if($model->save(false))
                return $this->redirect(['index']);
        }
        $model->u_password = null;
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewVa($id)
    {
        if(in_array(Yii::$app->user->identity->u_type, [2,3])) {
            if($id != Yii::$app->user->id)
            {
                throw new ForbiddenHttpException('Your are not allow to access this page', '403');
            }
        }

        return $this->render('view-va', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateVa()
    {
        $model = new User();
        $employee = new Employee();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post()) && $employee->load(Yii::$app->request->post())) {
            $model->u_photo = UploadedFile::getInstance($model,'u_photo');
            $model->u_password = md5($model->u_password);
            $model->u_type = 3;
            if($model->u_photo)
            {
                $model->u_photo->saveAs(Yii::getAlias('@webroot').'/images/user-images/'.$model->u_photo = 'user_'.date("d-m-Y_His").'.'.$model->u_photo->extension);
            }
            else
                $model->u_photo = NULL;

            $employee->e_email = $model->u_email;
            $employee->e_name = $model->u_name;
            $employee->e_roles = implode(',', $employee->e_roles);

            if($model->save(false))
            {
                $employee->e_user_id = $model->u_id;
                if($employee->save(false))
                    return $this->redirect(['va-list']);
            }
        }
        $model->u_password = null;
        return $this->render('create-va', [
            'model' => $model, 'employee' => $employee
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateVa($id)
    {
        if(in_array(Yii::$app->user->identity->u_type, [2,3])) {
            if($id != Yii::$app->user->id)
            {
                throw new ForbiddenHttpException('Your are not allow to access this page', '403');
            }
        }

        $model = $this->findModel($id);
        $checkEmp = 0;
        $employee = Employee::findOne(['e_user_id' => $model->u_id]);
        if(!$employee) {
            $employee = new Employee();
            $checkEmp = 1;
        }
        $oldImage = $model->u_photo;
        $oldPassword = $model->u_password;

        if($employee)
            $employee->e_roles = explode(',', $employee->e_roles);

        if ($model->load(Yii::$app->request->post()) && $employee->load(Yii::$app->request->post())) {
            $model->u_photo = UploadedFile::getInstance($model,'u_photo');

            if(!empty($model->u_password))
                $model->u_password = md5($model->u_password);
            else
                $model->u_password = $oldPassword;

            if($model->u_photo)
            {
                $model->u_photo->saveAs(Yii::getAlias('@webroot').'/images/user-images/'.$model->u_photo = 'user_'.date("d-m-Y_His").'.'.$model->u_photo->extension);
            }
            else
                $model->u_photo = $oldImage;

            $employee->e_email = $model->u_email;
            $employee->e_name = $model->u_name;
            $employee->e_roles = implode(',', $employee->e_roles);
            if($checkEmp) {
                $employee->e_user_id = $model->u_id;
            }

            if($model->save(false) && $employee->save(false))
                return $this->redirect(['va-list']);
        }
        $model->u_password = null;
        return $this->render('update-va', [
            'model' => $model, 'employee' => $employee
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteVa($id)
    {
        if(in_array(Yii::$app->user->identity->u_type, [2,3])) {
            if($id != Yii::$app->user->id)
            {
                throw new ForbiddenHttpException('Your are not allow to access this page', '403');
            }
        }

        $employee = Employee::findOne(['e_user_id' => $id]);

        if($employee->delete())
            $this->findModel($id)->delete();

        return $this->redirect(['va-list']);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(in_array(Yii::$app->user->identity->u_type, [2,3])) {
            if($id != Yii::$app->user->id)
            {
                throw new ForbiddenHttpException('Your are not allow to access this page', '403');
            }
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSwitchUser($id)
    {
        if(!Yii::$app->data->isSuperAdmin()) {
            throw new \yii\web\HttpException(401, 'You are not allowed to perform this action.');
        }
        $initialId = Yii::$app->user->id;
        if ($id == $initialId) {
            throw new \yii\web\HttpException(401, 'You are not allowed to perform this action.');
        } else {
            $user = $this->findModel($id);
            $duration = 0;
            \Yii::$app->user->switchIdentity($user, $duration);

            Yii::$app->session->set('user.idbeforeswitch', $initialId);
            return $this->redirect(['/site/index']); //redirect to any page you like.
        }
    }

    public function actionUserWishList()
    {
        $wishList = Yii::$app->session->get('uWishList');
        $wishListIdArray = Json::decode($wishList);
        $todaySearchModel = new TodayDealsSearch();
        $clearSearchModel = new ClearanceDataSearch();
        $userDataSearchModel = new UserDataSearch();
        //print_r($wishListIdArray); exit();
        $dataProvider = $dataProviderTd = $dataProviderUd = [];

        if($wishListIdArray['todayDeal'] || $wishListIdArray['clearanceDeal'] || $wishListIdArray['userDataDeal']) {
            $clearanceDeal= ClearanceData::find()->where(['IN', 'ud_id', $wishListIdArray['clearanceDeal']]);
            $todayDeal = TodayDeals::find()->where(['IN', 'td_id', $wishListIdArray['todayDeal']]);
            $userDeal = UserData::find()->where(['IN', 'ud_id', $wishListIdArray['userDataDeal']]);

            $dataProviderTd = $todaySearchModel->searchWishList(Yii::$app->request->queryParams, $todayDeal);
            $dataProvider = $clearSearchModel->searchWishList(Yii::$app->request->queryParams, $clearanceDeal);
            $dataProviderUd = $userDataSearchModel->searchWishList(Yii::$app->request->queryParams, $userDeal);

            if(Yii::$app->request->get('ac_id')) {
                $acId = Yii::$app->request->get('ac_id');

                // today's deal data
                $dataProviderTd->query->join('join', 'store_links sl', 'sl.sl_today_deal_id = td_id');
                $dataProviderTd->query->andFilterWhere(['like', 'sl_amazon_cats', $acId]);

                //clearance deal data
                $dataProvider->query->andFilterWhere(['like', 'ud_amazon_category', $acId]);


                //user deal data
                $dataProviderUd->query->andFilterWhere(['like', 'ud_amazon_category', $acId]);
            }

            if (Yii::$app->request->get('export')) {
                $linkIdArray = [];
                if(Yii::$app->session->get('uWishList'))
                {
                    $linkIdArray = \yii\helpers\Json::decode(Yii::$app->session->get('uWishList'));
                }
                $linkIdLink = ($linkIdArray) ? $linkIdArray['linkIdArray'] : [];
                $data = \app\models\StoreLinks::find()->where(['IN', 'sl_id', $linkIdLink]);
                $dataProviderL = new \yii\data\ActiveDataProvider([
                    'query' => $data,
                    'pagination' => false,
                    'sort' => ['defaultOrder' => ['sl_id' => SORT_DESC]]
                ]);

                $html = $this->renderPartial('wish-list-export',
                    [
                        'dataProvider' => $dataProvider,
                        'dataProviderTd' => $dataProviderTd,
                        'dataProviderUd' => $dataProviderUd,
                        'dataProviderL' => $dataProviderL,
                    ]);

                $fileName = 'Wish_List_Data.csv';  //'Wish_List_Data.xls'
                $options = ['mimeType' => 'application/vnd.ms-excel']; // application/vnd.ms-excel for .xls

                return Yii::$app->pdf->exportToCSV($html, $fileName);
                //return Yii::$app->response->sendContentAsFile($html, $fileName,$options);
            }
            //$uDeals = array_merge($clearanceDeal, $todayDeal);
        }

        return $this->render('wish-list', ['clearSearchModel' => $clearSearchModel, 'todaySearchModel' => $todaySearchModel, 'wishList' => $wishList, 'dataProvider' => $dataProvider, 'dataProviderTd' => $dataProviderTd, 'dataProviderUd' => $dataProviderUd, 'userDataSearchModel' => $userDataSearchModel]);
    }

    public function actionRemoveList($id, $type)
    {
        $todayDeal = $userDataDeal = $clearanceDeal = $storedCListArray = $storedTListArray = $idTArray = $idCArray = $linkIdArray = [];
        $status = null;

        if($type == 'clearanceDeal') {
            if(Yii::$app->session->get('uWishList')) {
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
            }
        }

        if($type == 'todayDeal') {
            if(Yii::$app->session->get('uWishList')) {
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
            }
        }

        if($type == 'linkIdArray') {
            if(Yii::$app->session->get('uWishList')) {
                $storedListJson = Yii::$app->session->get('uWishList');
                $storedTListArray = Json::decode($storedListJson);
            }
            $idTArray = [$id];
            if($storedTListArray) {
                $key = array_search($id, $storedTListArray['linkIdArray']);
                $idCArray = $storedTListArray['clearanceDeal'];
                $idTArray = $storedTListArray['todayDeal'];
                if($key !== false){
                    unset($storedTListArray['linkIdArray'][$key]);
                    $linkIdArray = $storedTListArray['linkIdArray'];
                    $status = 'R';
                }
            }
        }

        if($type == 'userDataDeal') {
            if(Yii::$app->session->get('uWishList')) {
                $storedListJson = Yii::$app->session->get('uWishList');
                $storedCListArray = Json::decode($storedListJson);
            }
            $idCArray = [$id];
            if($storedCListArray) {
                $key = array_search($id, $storedCListArray['userDataDeal']);
                $idTArray = $storedCListArray['todayDeal'];
                $idCArray = $storedCListArray['clearanceDeal'];
                $linkIdArray = $storedCListArray['linkIdArray'];
                if($key !== false){
                    unset($storedCListArray['userDataDeal'][$key]);
                    $userDataDeal = $storedCListArray['userDataDeal'];
                    $status = 'R';
                }
            }
        }

        $userWishList = ['todayDeal' => $idTArray, 'clearanceDeal' => $idCArray, 'linkIdArray' => $linkIdArray, 'userDataDeal' => $userDataDeal];
        $count = (empty($idTArray) && empty($idCArray) && empty($userDataDeal)) ? 0 : (count($linkIdArray) + count($idCArray) + count($userDataDeal));
        $userWishListJson = Json::encode($userWishList);

        Yii::$app->session->set('uWishList', $userWishListJson);
        Yii::$app->session->set('uWishListCount', $count);
        Yii::$app->session->setFlash('success', 'Row removed from Wish List successfully...');

        if(empty($idCArray) && empty($idTArray) && empty($userDataDeal)) {
            Yii::$app->session->remove('uWishList');
        }

        return $this->redirect(['/user/user-wish-list']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
