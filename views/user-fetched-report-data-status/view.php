<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserFetchedReportDataStatus */

$this->title = $model->ufrds_id;
$this->params['breadcrumbs'][] = ['label' => 'User Fetched Report Data Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-fetched-report-data-status-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ufrds_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ufrds_id], [
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
            'ufrds_id',
            'ufrds_reimbursement_report',
            'ufrds_return_report',
            'ufrds_inventory_adjustment_report',
            'ufrds_all_listing_report',
            'ufrds_received_inventory_report',
            'ufrds_restock_report',
            'ufrds_all_order_report',
            'ufrds_date',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
            'ufrds_user_id',
            'ufrds_status',
        ],
    ]) ?>

</div>
