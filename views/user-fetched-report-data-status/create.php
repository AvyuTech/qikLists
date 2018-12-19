<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserFetchedReportDataStatus */

$this->title = 'Create User Fetched Report Data Status';
$this->params['breadcrumbs'][] = ['label' => 'User Fetched Report Data Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-fetched-report-data-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
