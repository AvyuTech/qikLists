<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VaNotification */

$this->title = $model->vn_id;
$this->params['breadcrumbs'][] = ['label' => 'Va Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="va-notification-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->vn_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->vn_id], [
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
            'vn_id',
            'vn_va_id',
            'vn_seller_id',
            'vn_shipment_refund_event_data_id',
            'vn_amazon_order_id',
            'vn_refund_posted_date',
            'vn_is_seen',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'vn_status',
        ],
    ]) ?>

</div>
