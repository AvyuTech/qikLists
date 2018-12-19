<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderItemsAsin */

$this->title = 'Create Order Items Asin';
$this->params['breadcrumbs'][] = ['label' => 'Order Items Asins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-items-asin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
