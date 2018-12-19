<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderAdjustmentEventData */

$this->title = 'Create Order Adjustment Event Data';
$this->params['breadcrumbs'][] = ['label' => 'Order Adjustment Event Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-adjustment-event-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
