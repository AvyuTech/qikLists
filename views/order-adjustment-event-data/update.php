<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderAdjustmentEventData */

$this->title = 'Update Order Adjustment Event Data: ' . $model->oaed_id;
$this->params['breadcrumbs'][] = ['label' => 'Order Adjustment Event Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oaed_id, 'url' => ['view', 'id' => $model->oaed_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-adjustment-event-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
