<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FbaDailyInventoryData */

$this->title = $model->fdid_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba Daily Inventory Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-daily-inventory-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fdid_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fdid_id], [
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
            'fdid_id',
            'snapshot_date:ntext',
            'fnsku:ntext',
            'sku:ntext',
            'product_name:ntext',
            'quantity:ntext',
            'fulfillment_center_id:ntext',
            'detailed_disposition:ntext',
            'country:ntext',
            'fdid_date',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
