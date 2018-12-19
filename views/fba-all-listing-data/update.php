<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FbaAllListingData */

$this->title = 'Update Fba All Listing Data: ' . $model->fald_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba All Listing Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fald_id, 'url' => ['view', 'id' => $model->fald_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fba-all-listing-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
