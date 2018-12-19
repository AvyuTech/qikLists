<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FbaMonthlyInventoryHistoryCurrentReportData */

$this->title = $model->fmihcrd_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba Monthly Inventory History Current Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-monthly-inventory-history-current-report-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fmihcrd_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fmihcrd_id], [
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
            'fmihcrd_id',
            'month',
            'fnsku',
            'sku',
            'product_name',
            'average_quantity',
            'end_quantity',
            'fulfillment_center_id',
            'detailed_disposition',
            'country',
            'fmihcrd_date',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
