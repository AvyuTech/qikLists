<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderDataLog */

$this->title = $model->odl_id;
$this->params['breadcrumbs'][] = ['label' => 'Order Data Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-data-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->odl_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->odl_id], [
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
            'odl_id',
            'odl_user_id',
            'odl_order_id',
            'odl_shipment_data',
            'odl_refund_data',
            'odl_service_fee_data',
            'odl_adjustment_data',
            'odl_shipped_order_data',
            'odl_all_asin_data',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'odl_status',
        ],
    ]) ?>

</div>
