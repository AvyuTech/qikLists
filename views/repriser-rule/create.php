<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RepriserRule */

$this->title = 'Add New Repricer Rule';
$this->params['breadcrumbs'][] = ['label' => 'Manage Repricer Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
