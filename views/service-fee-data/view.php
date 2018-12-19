<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceFeeData */

$this->title = $model->sfd_id;
$this->params['breadcrumbs'][] = ['label' => 'Service Fee Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-fee-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->sfd_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->sfd_id], [
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
            'sfd_id',
            'sfd_amazon_order_id',
            'sfd_seller_order_id',
            'sfd_fee_reason',
            'sfd_fee_type',
            'sfd_fee_amount',
            'sfd_currency',
            'sfd_seller_sku',
            'sfd_fnsku',
            'sfd_fee_description:ntext',
            'sfd_asin',
            'sfd_shipment_refund_event_data_id',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
            'sfd_status',
        ],
    ]) ?>

</div>
