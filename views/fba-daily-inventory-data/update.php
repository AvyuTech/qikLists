<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FbaDailyInventoryData */

$this->title = 'Update Fba Daily Inventory Data: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Fba Daily Inventory Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fdid_id, 'url' => ['view', 'id' => $model->fdid_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="fba-daily-inventory-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
