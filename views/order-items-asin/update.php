<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItemsAsin */

$this->title = 'Update Order Items Asin: ' . $model->oia_id;
$this->params['breadcrumbs'][] = ['label' => 'Order Items Asins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oia_id, 'url' => ['view', 'id' => $model->oia_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-items-asin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
