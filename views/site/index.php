<?php

/* @var $this yii\web\View */

$this->title = 'Dashboard';
$this->registerCss('
.info-box-number {
    font-size: 35px;
}
');

/*$rr = Yii::$app->api->getReport();
print_r($rr); exit();*/
?>
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Sold in last 30 days</span>
                <span class="info-box-number">
                    <?=
                        \app\models\AllOrdesList::find()->andWhere(['<>', 'aol_order_status', 'Canceled'])->count();
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-usd"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Revenue in last 30 days</span>
                <span class="info-box-number">
                    <?php
                        $orderRevenue = \app\models\AllOrdesList::find()->andWhere(['<>', 'aol_order_status', 'Canceled'])->sum('aol_order_total');
                        echo  '$'.(($orderRevenue) ? $orderRevenue : 0);
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">No. of User</span>
                <span class="info-box-number">
                    <?=
                        \app\models\User::find()->andWhere(['<>', 'u_type', 1])->count();
                    ?>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>

<div class="row">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Select ASIN</h3>
        </div>
        <?= \yii\helpers\Html::beginForm(null, 'GET'); ?>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <?php
                    $asinAList = \app\models\FbaAllListingData::find()->andWhere(['status' => 'Active'])->all();
                    $asinList = \yii\helpers\ArrayHelper::map($asinAList, 'asin1', 'asin1');
                    ?>
                    <?= \yii\helpers\Html::dropDownList('asin', Yii::$app->request->get('asin'), $asinList, ['prompt' => '--- Select ASIN ---', 'class' => 'form-control']); ?>
                </div>
                <div class="col-xs-12 col-sm-4">
                    <?= \yii\helpers\Html::submitButton('Search', ['class' => 'btn btn-sm btn-info']); ?>
                    <?= \yii\helpers\Html::a('Reset', ['index'], ['class' => 'btn btn-sm btn-default']); ?>
                </div>
            </div>
            <?php
                if($asin = Yii::$app->request->get('asin')) {
            ?>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sold in last 30 days</span>
                                <span class="info-box-number">
                        <?php
                            $orderId = \app\models\OrderItemsAsin::find()->select(['oia_order_id'])->andWhere(['oia_asin' => $asin])->column();
                        ?>
                        <?=
                        \app\models\AllOrdesList::find()->andWhere(['<>', 'aol_order_status', 'Canceled'])->andWhere(['IN', 'aol_amazon_order_id', $orderId])->count();
                        ?>
                    </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-usd"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Revenue in last 30 days</span>
                                <span class="info-box-number">
                        <?php
                        $orderRevenue = \app\models\AllOrdesList::find()->andWhere(['<>', 'aol_order_status', 'Canceled'])->andWhere(['IN', 'aol_amazon_order_id', $orderId])->sum('aol_order_total');
                        echo  '$'.(($orderRevenue) ? $orderRevenue : 0);
                        ?>
                    </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
            <?php } ?>
        </div>
        <?= \yii\helpers\Html::endForm(); ?>
    </div>
</div>