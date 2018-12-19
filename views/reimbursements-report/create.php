<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ReimbursementsReport */

$this->title = 'Create Reimbursements Report';
$this->params['breadcrumbs'][] = ['label' => 'Reimbursements Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reimbursements-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
