<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItemChargeListData */

$this->title = $model->icld_id;
$this->params['breadcrumbs'][] = ['label' => 'Item Charge List Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-charge-list-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->icld_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->icld_id], [
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
            'icld_id',
            'icld_amazon_order_id',
            'icld_seller_order_id',
            'icld_item_charge_type',
            'icld_charge_amount',
            'icld_currency',
            'icld_shipment_refund_event_data_id',
            'icld_transaction_type',
            'icld_item_type',
            'updated_at',
            'created_at',
            'created_by',
            'updated_by',
            'icld_status',
        ],
    ]) ?>

</div>
