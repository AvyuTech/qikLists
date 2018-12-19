<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AllOrdesList */

$this->title = $model->aol_id;
$this->params['breadcrumbs'][] = ['label' => 'All Ordes Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="all-ordes-list-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->aol_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->aol_id], [
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
            'aol_id',
            'aol_amazon_order_id:ntext',
            'aol_seller_order_id:ntext',
            'aol_purchase_date',
            'aol_last_updated_date:ntext',
            'aol_order_status:ntext',
            'aol_fulfilment_channel:ntext',
            'aol_sales_channel:ntext',
            'aol_ship_service:ntext',
            'aol_order_total',
            'aol_shipped_items',
            'aol_unshipped_items',
            'created_at',
            'updated_at',
            'aol_status',
        ],
    ]) ?>

</div>
