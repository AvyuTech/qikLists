<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductOffers */

$this->title = 'Create Product Offers';
$this->params['breadcrumbs'][] = ['label' => 'Product Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-offers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
