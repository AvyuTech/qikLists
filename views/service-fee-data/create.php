<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ServiceFeeData */

$this->title = 'Create Service Fee Data';
$this->params['breadcrumbs'][] = ['label' => 'Service Fee Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-fee-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
