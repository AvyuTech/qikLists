<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItemsAsin */

$this->title = $model->oia_id;
$this->params['breadcrumbs'][] = ['label' => 'Order Items Asins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-items-asin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->oia_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->oia_id], [
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
            'oia_id',
            'oia_order_id',
            'oia_asin',
            'oia_category',
            'oia_referral_fee',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'oia_status',
        ],
    ]) ?>

</div>
