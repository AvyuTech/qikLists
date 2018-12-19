<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderDataLog */

$this->title = 'Create Order Data Log';
$this->params['breadcrumbs'][] = ['label' => 'Order Data Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-data-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
