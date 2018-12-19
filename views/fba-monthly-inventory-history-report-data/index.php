<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FbaMonthlyInventoryHistoryReportDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fba Monthly Inventory History Report Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-monthly-inventory-history-report-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fba Monthly Inventory History Report Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fmihrd_id',
            'month',
            'fnsku',
            'sku',
            'product_name',
            // 'average_quantity',
            // 'end_quantity',
            // 'fulfillment_center_id',
            // 'detailed_disposition',
            // 'country',
            // 'fmihrd_date',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
