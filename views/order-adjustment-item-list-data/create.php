<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderAdjustmentItemListData */

$this->title = 'Create Order Adjustment Item List Data';
$this->params['breadcrumbs'][] = ['label' => 'Order Adjustment Item List Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-adjustment-item-list-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
