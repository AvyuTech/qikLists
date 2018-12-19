<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductOffers */

$this->title = 'Update Product Offers: ' . $model->po_id;
$this->params['breadcrumbs'][] = ['label' => 'Product Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->po_id, 'url' => ['view', 'id' => $model->po_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-offers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
