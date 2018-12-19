<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FbaInventoryDetailsReportData */

$this->title = 'Update Fba Inventory Details Report Data: ' . $model->fidrd_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba Inventory Details Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fidrd_id, 'url' => ['view', 'id' => $model->fidrd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fba-inventory-details-report-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
