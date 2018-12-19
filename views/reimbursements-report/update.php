<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReimbursementsReport */

$this->title = 'Update Reimbursements Report: ' . $model->rr_id;
$this->params['breadcrumbs'][] = ['label' => 'Reimbursements Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rr_id, 'url' => ['view', 'id' => $model->rr_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reimbursements-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
