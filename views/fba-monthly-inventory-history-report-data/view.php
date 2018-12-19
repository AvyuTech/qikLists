<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FbaMonthlyInventoryHistoryReportData */

$this->title = $model->fmihrd_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba Monthly Inventory History Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-monthly-inventory-history-report-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fmihrd_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fmihrd_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fmihrd_id',
            'month',
            'fnsku',
            'sku',
            'product_name',
            'average_quantity',
            'end_quantity',
            'fulfillment_center_id',
            'detailed_disposition',
            'country',
            'fmihrd_date',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
