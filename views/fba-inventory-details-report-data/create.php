<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FbaInventoryDetailsReportData */

$this->title = 'Create Fba Inventory Details Report Data';
$this->params['breadcrumbs'][] = ['label' => 'Fba Inventory Details Report Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fba-inventory-details-report-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
