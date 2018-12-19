<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FbaDailyInventoryDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fba Daily Inventory Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-daily-inventory-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Fba Daily Inventory Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fdid_id',
            'snapshot_date:ntext',
            'fnsku:ntext',
            'sku:ntext',
            'product_name:ntext',
            //'quantity:ntext',
            //'fulfillment_center_id:ntext',
            //'detailed_disposition:ntext',
            //'country:ntext',
            //'fdid_date',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
