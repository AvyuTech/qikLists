<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemFeeListData */

$this->title = 'Update Item Fee List Data: ' . $model->ifld_id;
$this->params['breadcrumbs'][] = ['label' => 'Item Fee List Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ifld_id, 'url' => ['view', 'id' => $model->ifld_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-fee-list-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
