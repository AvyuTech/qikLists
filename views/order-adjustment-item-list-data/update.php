<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrderAdjustmentItemListData */

$this->title = 'Update Order Adjustment Item List Data: ' . $model->oaild_id;
$this->params['breadcrumbs'][] = ['label' => 'Order Adjustment Item List Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oaild_id, 'url' => ['view', 'id' => $model->oaild_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-adjustment-item-list-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
