<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FbaMonthlyInventoryHistoryCurrentReportData */

$this->title = 'Create Fba Monthly Inventory History Current Report Data';
$this->params['breadcrumbs'][] = ['label' => 'Fba Monthly Inventory History Current Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-monthly-inventory-history-current-report-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
