<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ReimbursementsReport */

$this->title = $model->rr_id;
$this->params['breadcrumbs'][] = ['label' => 'Reimbursements Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reimbursements-report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->rr_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->rr_id], [
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
            'rr_id',
            'approval_date',
            'reimbursement_id',
            'case_id',
            'amazon_order_id',
            'reason',
            'sku',
            'fnsku',
            'asin',
            'product_name',
            'condition',
            'currency_unit',
            'amount_per_unit',
            'amount_total',
            'quantity_reimbursed_cash',
            'quantity_reimbursed_inventory',
            'quantity_reimbursed_total',
            'original_reimbursement_id',
            'original_reimbursement_type',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
