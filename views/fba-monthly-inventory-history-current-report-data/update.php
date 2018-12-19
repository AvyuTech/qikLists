<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FbaMonthlyInventoryHistoryCurrentReportData */

$this->title = 'Update Fba Monthly Inventory History Current Report Data: ' . $model->fmihcrd_id;
$this->params['breadcrumbs'][] = ['label' => 'Fba Monthly Inventory History Current Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fmihcrd_id, 'url' => ['view', 'id' => $model->fmihcrd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fba-monthly-inventory-history-current-report-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
