<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FbaInventoryDetailsReportDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fba Inventory Details Report Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-inventory-details-report-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fba Inventory Details Report Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fidrd_id',
            'snapshot_date',
            'transaction_type',
            'fnsku',
            'sku',
            // 'product_name',
            // 'fulfillment_center_id',
            // 'quantity',
            // 'disposition',
            // 'fidrd_date',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
