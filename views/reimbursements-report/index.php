<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReimbursementsReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reimbursements Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reimbursements-report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reimbursements Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rr_id',
            'approval_date',
            'reimbursement_id',
            'case_id',
            'amazon_order_id',
            // 'reason',
            // 'sku',
            // 'fnsku',
            // 'asin',
            // 'product_name',
            // 'condition',
            // 'currency_unit',
            // 'amount_per_unit',
            // 'amount_total',
            // 'quantity_reimbursed_cash',
            // 'quantity_reimbursed_inventory',
            // 'quantity_reimbursed_total',
            // 'original_reimbursement_id',
            // 'original_reimbursement_type',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
