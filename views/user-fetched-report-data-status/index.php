<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserFetchedReportDataStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Fetched Report Data Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-fetched-report-data-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Fetched Report Data Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ufrds_id',
            'ufrds_reimbursement_report',
            'ufrds_return_report',
            'ufrds_inventory_adjustment_report',
            'ufrds_all_listing_report',
            // 'ufrds_received_inventory_report',
            // 'ufrds_restock_report',
            // 'ufrds_all_order_report',
            // 'ufrds_date',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',
            // 'ufrds_user_id',
            // 'ufrds_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
