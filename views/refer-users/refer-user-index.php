<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReferUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View Referred Users of '.$uModel->u_name;
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->u_type == 2) { ?>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-tags"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Referral Coupon Code</span>
                    <span class="info-box-number"><?= ($afModel) ? $afModel->a_affiliate_coupon : '(not set)'; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-link"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Referral Link</span>
                    <span class="info-box-number"><?= ($afModel) ? 'https://www.qikbulk.com/refer?code='.$afModel->a_affiliate_coupon : null; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Referred Users</span>
                    <span class="info-box-number"><?= $dataProvider->totalCount; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-bank"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Connect Stripe Account</span>
                    <span class="info-box-number">
                        <?php
                            $afModel = \app\models\Affiliates::findOne(['a_user_id' => Yii::$app->user->id]);
                            $afVisible = ($afModel && $afModel->a_status == 0 && empty(Yii::$app->user->identity->u_stripe_account_id)) ? true : false;
                            if($afVisible) {
                        ?>
                            <a href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id=<?= Yii::$app->params['stripeConnectClientId']; ?>&scope=read_write" title="Connect with Stripe"><img src="<?= Yii::getAlias('@web'); ?>/images/blue-on-light.png"/></a>
                        <?php } else {
                                echo "Connected";
                            } ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
<?php } ?>


<div class="box box-default">
    <?php $form = ActiveForm::begin([
        'action' => ['get-users', 'id' => $uModel->u_id],
        'method' => 'get',
    ]); ?>
    <div class="box-header with-border">
        <h3 class="box-title">Search By</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <?= $form->field($searchModel, 'ru_refer_date')->dropDownList($searchModel->getMonthsName(), ['prompt' => '--- Select Month ---']); ?>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?= $form->field($searchModel, 'ru_payment_status')->dropDownList($searchModel->getPaymentStatus(), ['prompt' => '--- Select Status ---']); ?>
            </div>
        </div>
        <?php if($dataProvider->getTotalCount() > 0) { ?>
            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <?php
                        $approvedPayment = \app\models\ReferUsers::find()->where(['ru_refered_by' => $uModel->u_id, 'ru_payment_status' => 1])->andFilterWhere(['MONTH(ru_refer_date)' => $searchModel->ru_refer_date, 'ru_payment_status' => $searchModel->ru_payment_status])->sum('ru_payment_amount');
                    ?>
                    <h3>Approved Payment : <b>$ <?= ($approvedPayment) ? $approvedPayment : 0; ?></b></h3>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <?php
                        $pendingPayment = \app\models\ReferUsers::find()->where(['ru_refered_by' => $uModel->u_id, 'ru_payment_status' => 2])->andFilterWhere(['MONTH(ru_refer_date)' => $searchModel->ru_refer_date, 'ru_payment_status' => $searchModel->ru_payment_status])->sum('ru_payment_amount');
                    ?>
                    <h3>Pending Payment : <b>$ <?= ($pendingPayment) ? $pendingPayment : 0; ?></b></h3>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Cancel', ['get-users', 'id' => $uModel->u_id], ['class' => 'btn btn-default']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="box box-default">

    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'ru_refer_user_id',
                    'value' => function($model) {
                        return ($model->user) ? $model->user->u_name : null;
                    }
                ],
                'ru_used_promo_code',
                'ru_plan',
                [
                    'attribute' => 'ru_refer_date',
                    'filter' => \app\models\ReferUsers::getMonthsName(),
                ],
                'ru_payment_amount',
                //'ru_payout_months',
                [
                    'attribute' => 'ru_payout_months_done',
                    'value' => function($model) {
                           return ($model->ru_payout_months) ? $model->ru_payout_months_done."/".$model->ru_payout_months : '';
                    },
                ],
                [
                    'attribute' => 'ru_payment_status',
                    'value' => function($model) {
                        $pStatus = ($model->ru_payment_status) ? $model->getPaymentStatus($model->ru_payment_status) : null;

                        return ($pStatus) ? (($pStatus == 'Approved') ? '<span class="label label-success">Approved</span>' : (($pStatus == 'Pending') ? '<span class="label label-warning">Pending</span>' : '<span class="label label-danger">Reject</span>' )) : '-';
                    },
                    'format' => 'raw',
                    'filter' => \app\models\ReferUsers::getPaymentStatus(),
                ],
                [
                    'header' => 'Update Payout Months',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}',
                    'contentOptions' => ['class' => 'text-center'],
                ],
            ],
        ]); ?>
    </div>
</div>
