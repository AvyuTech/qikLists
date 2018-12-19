<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AllOrdesList */

$this->title = 'Update All Ordes List: ' . $model->aol_id;
$this->params['breadcrumbs'][] = ['label' => 'All Ordes Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aol_id, 'url' => ['view', 'id' => $model->aol_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="all-ordes-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
