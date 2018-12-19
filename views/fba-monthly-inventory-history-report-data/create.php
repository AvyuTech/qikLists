<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FbaMonthlyInventoryHistoryReportData */

$this->title = 'Create Fba Monthly Inventory History Report Data';
$this->params['breadcrumbs'][] = ['label' => 'Fba Monthly Inventory History Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-monthly-inventory-history-report-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
