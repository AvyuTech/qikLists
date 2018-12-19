<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceFeeData */

$this->title = 'Update Service Fee Data: ' . $model->sfd_id;
$this->params['breadcrumbs'][] = ['label' => 'Service Fee Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sfd_id, 'url' => ['view', 'id' => $model->sfd_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="service-fee-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
