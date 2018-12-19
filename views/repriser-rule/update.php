<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RepriserRule */

$this->title = 'Update Repricer Rule: ' . $model->rr_name;
$this->params['breadcrumbs'][] = ['label' => 'Manage Repricer Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box box-info">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
