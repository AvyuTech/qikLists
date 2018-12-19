<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserFetchedReportDataStatus */

$this->title = 'Update User Fetched Report Data Status: ' . $model->ufrds_id;
$this->params['breadcrumbs'][] = ['label' => 'User Fetched Report Data Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ufrds_id, 'url' => ['view', 'id' => $model->ufrds_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-fetched-report-data-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
